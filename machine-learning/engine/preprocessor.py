import pandas as pd
import re

def saring_lowongan_berdasarkan_kriteria(df_mentah: pd.DataFrame, payload) -> pd.DataFrame:
    df = df_mentah.copy()
    if df.empty: return df

    mhs = payload.mahasiswa
    pref = payload.preferensi

    minat_array = [m.strip().lower() for m in pref.minat_bidang] if pref.minat_bidang else []
    lokasi_array = [l.strip().lower() for l in pref.lokasi] if pref.lokasi else []
    instansi_input = pref.jenis_instansi.strip().lower() if pref.jenis_instansi else ""
    jenis_magang_input = pref.jenis_magang.strip().lower() if pref.jenis_magang else ""

    # 1. IPK
    df['ipk_min'] = pd.to_numeric(df['ipk_min'], errors='coerce').fillna(0)
    df = df[df['ipk_min'] <= mhs.ipk]

    # 2. Minat Bidang
    if minat_array:
        pola_minat = '|'.join(re.escape(m) for m in minat_array)
        df = df[df['posisi'].str.contains(pola_minat, case=False, na=False)]

    # 3. Lokasi
    if lokasi_array:
        pola_lokasi = '|'.join(lokasi_array)
        df = df[df['lokasi_perusahaan'].str.contains(pola_lokasi, case=False, na=False)]

    # 4. Jenis Instansi
    if instansi_input and instansi_input != "semua":
        df = df[df['jenis_perusahaan'].str.lower() == instansi_input]

    # 5. Paid/Unpaid
    if jenis_magang_input and jenis_magang_input != "semua":
        if jenis_magang_input == "paid":
            df = df[df['insentif'].astype(str).str.lower() == 'paid']
        elif jenis_magang_input == "unpaid":
            df = df[df['insentif'].astype(str).str.lower() != 'paid']

    return df