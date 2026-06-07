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
            [
                'id_matkul'   => 'MK230001',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Dasar Pemrograman',
                'keahlian'    => 'Programming, Java, Python',
                'tools'       => 'Git, GitHub',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Algoritma dan Struktur Data',
                'keahlian'    => 'Algorithm, Data Structure, Java, Python',
                'tools'       => '-',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230003',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Sistem Operasi',
                'keahlian'    => 'Operating System, Bash, Linux',
                'tools'       => 'VirtualBox, VMware, Docker, WSL',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230004',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data',
                'keahlian'    => 'Database Management, SQL',
                'tools'       => 'MySQL Workbench, phpMyAdmin, DBeaver',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230005',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'keahlian'    => 'Computer Networking',
                'tools'       => 'Cisco Packet Tracer, GNS3, Wireshark, Nmap, WinBox',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230006',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web',
                'keahlian'    => 'Web Development, HTML, CSS, JavaScript, PHP',
                'tools'       => 'Bootstrap, Tailwind CSS, Postman',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data Lanjut',
                'keahlian'    => 'Database Management, SQL',
                'tools'       => 'PostgreSQL, SQL Server, MongoDB, Redis, pgAdmin, DBeaver',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230008',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Rekayasa Perangkat Lunak',
                'keahlian'    => 'Software Engineering, Project Management, System Analysis',
                'tools'       => 'Enterprise Architect, draw.io, Trello, Jira, Notion, Git',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230009',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Pemrograman Berbasis Objek',
                'keahlian'    => 'Object Oriented Programming, Java, Python, PHP, C++',
                'tools'       => '-',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230010',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Warehouse',
                'keahlian'    => 'Data Warehouse, Data Analysis, SQL',
                'tools'       => 'Pentaho, Power BI, Looker Studio, SQL Server, PostgreSQL',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230011',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web Lanjut',
                'keahlian'    => 'Web Development, REST API, PHP, JavaScript',
                'tools'       => 'Laravel, React.js, Next.js, Node.js, Postman, Docker',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230012',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis dan Perancangan Sistem Informasi',
                'keahlian'    => 'System Analysis, System Design',
                'tools'       => 'draw.io, Lucidchart, Microsoft Visio',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230013',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Mining',
                'keahlian'    => 'Data Mining, Machine Learning, Python, R',
                'tools'       => 'Pandas, NumPy, Scikit-learn, Matplotlib',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230014',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Penjaminan Mutu Perangkat Lunak',
                'keahlian'    => 'Software Testing, Quality Assurance, Java, Python, JavaScript',
                'tools'       => 'Selenium, Playwright, Postman, JMeter',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230015',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Mobile',
                'keahlian'    => 'Mobile Development, Dart, JavaScript',
                'tools'       => 'Android Studio, Flutter, React Native, Firebase',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230016',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Audit Sistem Informasi',
                'keahlian'    => 'Information System Audit, IT Governance, Compliance',
                'tools'       => 'COBIT, ISO 27001, Microsoft Excel',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230017',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Statistika',
                'keahlian'    => 'Statistics, Data Analysis, Python, R',
                'tools'       => 'Microsoft Excel, RStudio, SPSS',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_matkul'   => 'MK230018',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis Proses Bisnis',
                'keahlian'    => 'Business Analysis, System Analysis',
                'tools'       => 'draw.io, Lucidchart, Microsoft Visio, Microsoft Excel',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('mata_kuliah_models')->insert($mataKuliah);
    }
}