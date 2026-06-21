import os
import requests
from dotenv import load_dotenv

load_dotenv()

def get_lowongan_aktif():
    api_url = os.getenv("API_URL_PERUSAHAAN", "https://jti-portal.vercel.app/api/lowongan")
    
    try:
        response = requests.get(api_url, timeout=10)
        
        if response.status_code == 200:
            json_response = response.json()
            
            if json_response.get('success') == True:
                data_mentah = json_response.get('data', [])
                data_bersih_rata = []
                
                # Flattening Data
                for item in data_mentah:
                    lowongan_flat = {
                        "lowongan_id": item.get("lowongan_id"),
                        "posisi": item.get("posisi"),
                        "deskripsi": item.get("deskripsi"),
                        "tools": item.get("tools"),
                        "skill": item.get("skill"),
                        "ipk_min": item.get("ipk_min"),
                        "periode": item.get("periode"),
                        "insentif": item.get("insentif"),
                        "status": item.get("status"),
                    }
                    
                    relasi_perusahaan = item.get("perusahaan", {})
                    lowongan_flat["nama_perusahaan"] = relasi_perusahaan.get("nama_perusahaan")
                    lowongan_flat["jenis_perusahaan"] = relasi_perusahaan.get("jenis_perusahaan")
                    lowongan_flat["lokasi_perusahaan"] = relasi_perusahaan.get("lokasi")
                        
                    data_bersih_rata.append(lowongan_flat)
                
                return data_bersih_rata
            
            else:
                print(f"[Error Fetcher] API merespon success: false.")
                return None
        else:
            print(f"[Error Fetcher] API Gagal, HTTP Status: {response.status_code}")
            return None
            
    except requests.exceptions.ConnectionError:
        print("[Error Fetcher] Gagal terhubung ke jtiportal.")
        return None
    except Exception as e:
        print(f"[Error Fetcher] Terjadi kesalahan: {str(e)}")
        return None