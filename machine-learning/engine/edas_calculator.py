import numpy as np
import pandas as pd

def hitung_skor_edas(df_tersaring: pd.DataFrame, payload) -> pd.DataFrame:
    df = df_tersaring.copy()
    if len(df) <= 1:
        df['skor_edas'] = 1.0 if len(df) == 1 else 0.0
        return df

    # =========================================================================
    # TAHAP 1: PENENTUAN SKOR (SCORING) MATRIKS KEPUTUSAN
    # =========================================================================
    
    # 1. Ekstrak himpunan array dari payload mahasiswa
    keahlian_mhs_set = set([k.strip().lower() for k in payload.mahasiswa.keahlian.split(',')]) if payload.mahasiswa.keahlian else set()
    tools_mhs_set = set([t.strip().lower() for t in payload.mahasiswa.tools.split(',')]) if getattr(payload.mahasiswa, 'tools', None) else set()

    # Fungsi pembantu untuk menghitung irisan skill
    def hitung_match_skill(baris):
        if not keahlian_mhs_set: return 0
        skill_perusahaan = set([s.strip().lower() for s in str(baris.get('skill', '')).split(',')])
        return len(keahlian_mhs_set.intersection(skill_perusahaan))

    # Fungsi pembantu untuk menghitung irisan tools
    def hitung_match_tools(baris):
        if not tools_mhs_set: return 0
        tools_perusahaan = set([t.strip().lower() for t in str(baris.get('tools', '')).split(',')])
        return len(tools_mhs_set.intersection(tools_perusahaan))

    # 2. Terapkan skoring ke kolom Kriteria (C1 - C5)
    df['C1_Skill'] = df.apply(hitung_match_skill, axis=1)
    df['C2_Tools'] = df.apply(hitung_match_tools, axis=1)
    
    df['C3_Periode'] = pd.to_numeric(df['periode'], errors='coerce').fillna(0)
    df['C4_Paid'] = np.where(df['insentif'].astype(str).str.lower() == 'paid', 1.0, 0.0)

    # Hierarki Instansi (Ubah teks menjadi angka untuk C5)
    skor_instansi = {
        'bumn': 3.0,
        'industri': 2.0,
        'startup': 1.0,
        'pemerintahan': 1.0
    }
    df['C5_Instansi'] = df['jenis_perusahaan'].astype(str).str.lower().map(skor_instansi).fillna(0.0)

    # 3. Bentuk Matriks Keputusan (X) dan Bobot (W)
    X = df[['C1_Skill', 'C2_Tools', 'C3_Periode', 'C4_Paid', 'C5_Instansi']].values.astype(float)
    
    # Komposisi Bobot: Skill(35%), Tools(25%), Periode(15%), Paid(10%), Instansi(15%) = Total 1.0
    W = np.array([0.35, 0.25, 0.15, 0.10, 0.15]) 

    # =========================================================================
    # TAHAP 2: PERHITUNGAN ALGORITMA EDAS (SEMUA BENEFIT)
    # =========================================================================
    
    AV = np.mean(X, axis=0)
    AV_safe = np.where(AV == 0, 1e-9, AV) # Hindari error division by zero

    PDA = np.maximum(0, (X - AV)) / AV_safe
    NDA = np.maximum(0, (AV - X)) / AV_safe

    SP = PDA @ W
    SN = NDA @ W

    max_SP = np.max(SP) if np.max(SP) != 0 else 1e-9
    max_SN = np.max(SN) if np.max(SN) != 0 else 1e-9
    
    NSP = SP / max_SP
    NSN = 1 - (SN / max_SN)
    
    # =========================================================================
    # TAHAP 3: FINALISASI HASIL
    # =========================================================================
    
    df['skor_edas'] = 0.5 * (NSP + NSN)
    
    # Hapus kolom bantuan komputasi agar tidak memberatkan memori sebelum dikembalikan ke routes.py
    kolom_hapus = ['C1_Skill', 'C2_Tools', 'C3_Periode', 'C4_Paid', 'C5_Instansi']
    df = df.drop(columns=kolom_hapus, errors='ignore')

    return df.sort_values(by='skor_edas', ascending=False)