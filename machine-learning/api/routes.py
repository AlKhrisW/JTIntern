from fastapi import APIRouter, HTTPException
from pydantic import BaseModel
from typing import List
import pandas as pd
from datetime import datetime, timezone

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
    keahlian: List[str]
    tools: List[str]

class PreferensiData(BaseModel):
    jenis_magang: str
    minat_bidang: List[str]
    jenis_instansi: str
    lokasi: List[str]

class InputPayload(BaseModel):
    mahasiswa: MahasiswaData
    preferensi: PreferensiData
    timestamp: str

@api_router.post("/api/hitung-rekomendasi")
async def proses_rekomendasi(payload: InputPayload):

    # 1. Ambil data lowongan aktif dari API portal
    data_lowongan_mentah = get_lowongan_aktif()
    if not data_lowongan_mentah:
        raise HTTPException(
            status_code=502,
            detail="Gagal mengambil data lowongan. Periksa koneksi ke JTI Portal."
        )

    df_lowongan = pd.DataFrame(data_lowongan_mentah)

    # 2. Preprocessing — filter mutlak berdasarkan preferensi
    df_tersaring = saring_lowongan_berdasarkan_kriteria(df_lowongan, payload)

    mahasiswa_info = {
        "nim":   payload.mahasiswa.nim,
        "nama":  payload.mahasiswa.nama,
        "prodi": payload.mahasiswa.program_studi,
    }

    if df_tersaring.empty:
        return {
            "status":       "success",
            "mahasiswa":    mahasiswa_info,
            "rekomendasi":  [],
            "pesan":        "Tidak ada lowongan yang sesuai dengan kriteria yang dipilih.",
            "generated_at": datetime.now(timezone.utc).isoformat(),
        }

    # 3. Hitung skor EDAS dan buat ranking
    hasil_ranking_df = hitung_skor_edas(df_tersaring, payload)

    # 4. Format kolom hasil yang akan dikirim ke Laravel
    kolom_hasil = [
        "lowongan_id",
        "nama_perusahaan",
        "posisi",
        "lokasi_perusahaan",
        "jenis_perusahaan",
        "skor_edas",
    ]

    # Pastikan hanya kolom yang tersedia yang diambil (defensive)
    kolom_tersedia = [k for k in kolom_hasil if k in hasil_ranking_df.columns]
    hasil_akhir = hasil_ranking_df[kolom_tersedia].to_dict(orient="records")

    return {
        "status":       "success",
        "mahasiswa":    mahasiswa_info,
        "rekomendasi":  hasil_akhir,
        "generated_at": datetime.now(timezone.utc).isoformat(),
    }