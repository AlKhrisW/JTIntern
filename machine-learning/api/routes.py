from fastapi import APIRouter, HTTPException
from pydantic import BaseModel
import pandas as pd

from services.data_fetcher import get_lowongan_aktif
from engine.preprocessor import saring_lowongan_berdasarkan_kriteria
from engine.edas_calculator import hitung_skor_edas

api_router = APIRouter()

class MahasiswaData(BaseModel):
    nim: str
    nama: str
    email: str
    program_studi: str
    ipk: float
    keahlian: str

class PreferensiData(BaseModel):
    jenis_magang: str
    minat_bidang: str
    jenis_instansi: str
    lokasi: str

class InputPayload(BaseModel):
    mahasiswa: MahasiswaData
    preferensi: PreferensiData
    timestamp: str

@api_router.post("/api/hitung-rekomendasi")
async def proses_rekomendasi(payload: InputPayload):
    
    # 1. Ambil Data API
    data_lowongan_mentah = get_lowongan_aktif()
    if not data_lowongan_mentah:
        raise HTTPException(status_code=500, detail="Gagal mengambil data kelola perusahaan.")
        
    df_lowongan = pd.DataFrame(data_lowongan_mentah)
    
    # 2. Preprocessing (Filtering Mutlak)
    df_tersaring = saring_lowongan_berdasarkan_kriteria(df_lowongan, payload)
    
    if df_tersaring.empty:
        return {
            "status": "success",
            "mahasiswa": {"nim": payload.mahasiswa.nim, "nama": payload.mahasiswa.nama},
            "pesan": "Tidak ada lowongan yang sesuai kriteria.",
            "rekomendasi": []
        }

    # 3. Hitung Skor EDAS
    hasil_ranking_df = hitung_skor_edas(df_tersaring, payload)
    
    # 4. Format Hasil
    kolom_hasil = ['lowongan_id', 'nama_perusahaan', 'posisi', 'skor_edas']
    hasil_akhir = hasil_ranking_df[kolom_hasil].to_dict(orient='records')
    
    return {
        "status": "success",
        "mahasiswa": {
            "nim": payload.mahasiswa.nim,
            "nama": payload.mahasiswa.nama,
            "prodi": payload.mahasiswa.program_studi
        },
        "rekomendasi": hasil_akhir
    }