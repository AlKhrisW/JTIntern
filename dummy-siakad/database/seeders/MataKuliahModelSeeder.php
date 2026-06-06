<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MataKuliahModelSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $mataKuliah = [
            // MK230001 - Praktikum Dasar Pemrograman
            [
                'id_matkul'   => 'MK230001',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Dasar Pemrograman',
                'keahlian'    => 'Java, Python',
                'tools'       => 'Visual Studio Code, NetBeans, Git, GitHub',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230002 - Praktikum Algoritma dan Struktur Data
            [
                'id_matkul'   => 'MK230002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Algoritma dan Struktur Data',
                'keahlian'    => 'Java, Python',
                'tools'       => 'Visual Studio Code, IntelliJ IDEA',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230003 - Sistem Operasi
            [
                'id_matkul'   => 'MK230003',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Sistem Operasi',
                'keahlian'    => 'Bash',
                'tools'       => 'VirtualBox, VMware, Docker Desktop, Ubuntu Terminal, PuTTY, WSL',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230004 - Praktikum Basis Data
            [
                'id_matkul'   => 'MK230004',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data',
                'keahlian'    => 'SQL',
                'tools'       => 'XAMPP, Laragon, MySQL Workbench, phpMyAdmin, DBeaver',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230005 - Praktikum Jaringan Komputer
            [
                'id_matkul'   => 'MK230005',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'keahlian'    => '-',
                'tools'       => 'Cisco Packet Tracer, GNS3, Wireshark, Nmap, WinBox, PuTTY',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230006 - Pemrograman Web
            [
                'id_matkul'   => 'MK230006',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web',
                'keahlian'    => 'JavaScript, PHP',
                'tools'       => 'HTML, CSS, Visual Studio Code, XAMPP, Bootstrap, Tailwind CSS, Postman',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230007 - Praktikum Basis Data Lanjut
            [
                'id_matkul'   => 'MK230007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data Lanjut',
                'keahlian'    => 'SQL, PL/pgSQL',
                'tools'       => 'PostgreSQL, SQL Server, MongoDB, Redis, pgAdmin, DBeaver',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230008 - Rekayasa Perangkat Lunak
            [
                'id_matkul'   => 'MK230008',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Rekayasa Perangkat Lunak',
                'keahlian'    => '-',
                'tools'       => 'Enterprise Architect, draw.io, Trello, Jira, Notion, Git',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230009 - Praktikum Pemrograman Berbasis Objek
            [
                'id_matkul'   => 'MK230009',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Pemrograman Berbasis Objek',
                'keahlian'    => 'Java, Python, PHP, C++',
                'tools'       => 'NetBeans, IntelliJ IDEA, Visual Studio Code',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230010 - Data Warehouse
            [
                'id_matkul'   => 'MK230010',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Warehouse',
                'keahlian'    => 'SQL',
                'tools'       => 'Pentaho Data Integration, Power BI, Looker Studio, SQL Server, PostgreSQL',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230011 - Pemrograman Web Lanjut
            [
                'id_matkul'   => 'MK230011',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web Lanjut',
                'keahlian'    => 'PHP, JavaScript',
                'tools'       => 'Visual Studio Code, Laravel, React.js, Next.js, Node.js, Postman, Docker',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230012 - Analisis dan Perancangan Sistem Informasi
            [
                'id_matkul'   => 'MK230012',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis dan Perancangan Sistem Informasi',
                'keahlian'    => '-',
                'tools'       => 'draw.io, Lucidchart, Microsoft Visio',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230013 - Data Mining
            [
                'id_matkul'   => 'MK230013',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Mining',
                'keahlian'    => 'Python, R',
                'tools'       => 'Jupyter Notebook, Pandas, NumPy, Scikit-learn, Matplotlib',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230014 - Penjaminan Mutu Perangkat Lunak
            [
                'id_matkul'   => 'MK230014',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Penjaminan Mutu Perangkat Lunak',
                'keahlian'    => 'Java, Python, JavaScript',
                'tools'       => 'Selenium, Playwright, Postman, JMeter',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230015 - Pemrograman Mobile
            [
                'id_matkul'   => 'MK230015',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Mobile',
                'keahlian'    => 'Dart, JavaScript',
                'tools'       => 'Android Studio, Visual Studio Code, Flutter, React Native, Firebase',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230016 - Audit Sistem Informasi
            [
                'id_matkul'   => 'MK230016',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Audit Sistem Informasi',
                'keahlian'    => '-',
                'tools'       => 'COBIT Framework templates, ISO 27001 Toolkit, Microsoft Excel',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230017 - Statistika
            [
                'id_matkul'   => 'MK230017',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Statistika',
                'keahlian'    => 'Python, R',
                'tools'       => 'Microsoft Excel, RStudio, Jupyter Notebook, SPSS',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK230018 - Analisis Proses Bisnis
            [
                'id_matkul'   => 'MK230018',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis Proses Bisnis',
                'keahlian'    => '-',
                'tools'       => 'draw.io, Lucidchart, Microsoft Visio, Microsoft Office',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('mata_kuliah_models')->insert($mataKuliah);
    }
}