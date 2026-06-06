import pandas as pd

def saring_lowongan_berdasarkan_kriteria(df_mentah: pd.DataFrame, payload) -> pd.DataFrame:
    df = df_mentah.copy()
    if df.empty: return df

    mhs = payload.mahasiswa
    pref = payload.preferensi

    # --- A. Normalisasi Input Sederhana ---
    minat_array = [m.strip().lower() for m in pref.minat_bidang] if pref.minat_bidang else []
    lokasi_array = [l.strip().lower() for l in pref.lokasi] if pref.lokasi else []
    instansi_input = pref.jenis_instansi.strip().lower() if pref.jenis_instansi else ""
    jenis_magang_input = pref.jenis_magang.strip().lower() if pref.jenis_magang else ""

    # --- B. Eksekusi Filtering ---
    # 1. IPK
    df['ipk_min'] = pd.to_numeric(df['ipk_min'], errors='coerce').fillna(0)
    df = df[df['ipk_min'] <= mhs.ipk]

    # 2. Minat Bidang
    if minat_array:
        pola_minat = '|'.join(minat_array)
        df = df[df['posisi'].str.contains(pola_minat, case=False, na=False)]

    # 3. Lokasi
    if lokasi_array:
        df = df[df['lokasi_perusahaan'].str.lower().isin(lokasi_array)]

    # 4. Jenis Instansi
    if instansi_input and instansi_input != "semua":
        df = df[df['jenis_perusahaan'].str.lower() == instansi_input]

    # 5. Paid/Unpaid
    if jenis_magang_input and jenis_magang_input != "semua":
        df['insentif_angka'] = pd.to_numeric(df['insentif'], errors='coerce').fillna(0)
        if jenis_magang_input == "paid":
            df = df[df['insentif_angka'] > 0]
        elif jenis_magang_input == "unpaid":
            df = df[df['insentif_angka'] == 0]

    # Hapus kolom bantuan
    return df.drop(columns=['insentif_angka'], errors='ignore')