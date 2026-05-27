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
            // MK231009 - Praktikum Dasar Pemrograman
            [
                'id_matkul'   => 'MK231009',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Dasar Pemrograman',
                'keahlian'    => 'Dasar Algoritma, Flowchart, Pseudocode, Variabel, Tipe Data, Operator, Percabangan, Perulangan, Function, Array, OOP, Problem Solving, C++, Java, Python, JavaScript, Git, GitHub',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK232005 - Praktikum Algoritma dan Struktur Data
            [
                'id_matkul'   => 'MK232005',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Algoritma dan Struktur Data',
                'keahlian'    => 'Algoritma Sorting, Algoritma Searching, Stack, Queue, Linked List, Tree, Graph, Rekursi, Kompleksitas Algoritma, Dynamic Programming, Greedy Algorithm, Java, Python, C++, Problem Solving, Visual Studio Code, IntelliJ IDEA, Python IDLE, LeetCode, HackerRank, VisuAlgo, Draw.io',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK232009 - Sistem Operasi
            [
                'id_matkul'   => 'MK232009',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Sistem Operasi',
                'keahlian'    => 'Linux, Bash / Shell, Manajemen Proses, Manajemen Memori, File System, Scheduling, Virtual Machine, Linux Server, Ubuntu, Debian, Command Line Interface, Virtualisasi, Docker, VirtualBox, VMware, Ubuntu, Debian, Docker Desktop, Terminal / Bash, PuTTY, Windows Subsystem for Linux (WSL)',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK232007 - Praktikum Basis Data
            [
                'id_matkul'   => 'MK232007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data',
                'keahlian'    => 'SQL, MySQL, ERD, Normalisasi Database, DDL, DML, Query, Join, Subquery, Index, Stored Procedure, View, Trigger, Database Design, phpMyAdmin, MySQL Workbench, phpMyAdmin, XAMPP, Laragon, DBeaver, Draw.io / dbdiagram.io, SQL Fiddle',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK233002 - Praktikum Jaringan Komputer
            [
                'id_matkul'   => 'MK233002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Jaringan Komputer',
                'keahlian'    => 'TCP/IP, Subnetting, Routing, Switching, Cisco / Mikrotik, Cisco Packet Tracer, Network Topology Design, Wireshark, Network Administration, IP Configuration, Firewall, VLAN, DNS, DHCP, Network Security, Cisco Packet Tracer, GNS3 / PNetLab, Wireshark, Nmap, MikroTik WinBox, VirtualBox, PuTTY, Advanced IP Scanner',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK233008 - Pemrograman Web
            [
                'id_matkul'   => 'MK233008',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web',
                'keahlian'    => 'HTML & CSS, JavaScript, PHP, Bootstrap, Tailwind CSS, jQuery, Responsive Design, REST API, Git & GitHub, Visual Studio Code, DOM Manipulation, Web Development, Figma, UI/UX Design, Visual Studio Code, XAMPP / Laragon, Git & GitHub, Figma, Chrome DevTools, Postman, Live Server Extension, Bootstrap CDN',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK233007 - Praktikum Basis Data Lanjut
            [
                'id_matkul'   => 'MK233007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Basis Data Lanjut',
                'keahlian'    => 'PostgreSQL, SQL Server, Stored Procedure Lanjut, Trigger Lanjut, Database Tuning, Replikasi Database, NoSQL, MongoDB, Redis, Transaction Management, Backup & Recovery, Query Optimization, DBeaver, pgAdmin, SQL Server Management Studio (SSMS), MongoDB Compass, Redis CLI, TablePlus, Robo 3T',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK233003 - Rekayasa Perangkat Lunak
            [
                'id_matkul'   => 'MK233003',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Rekayasa Perangkat Lunak',
                'keahlian'    => 'Software Development Life Cycle (SDLC), UML Modeling, Use Case Diagram, Sequence Diagram, ERD, Analisis Kebutuhan, Software Testing, Dokumentasi Teknis, Git & GitHub, Agile / Scrum, Trello / Jira / Notion, Postman',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK233005 - Praktikum Pemrograman Berbasis Objek
            [
                'id_matkul'   => 'MK233005',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Praktikum Pemrograman Berbasis Objek',
                'keahlian'    => 'OOP, Encapsulation, Inheritance, Polymorphism, Abstraction, Design Pattern, Java, Python, PHP, C++, C#, UML Modeling, Git & GitHub, Problem Solving',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK234005 - Data Warehouse
            [
                'id_matkul'   => 'MK234005',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Warehouse',
                'keahlian'    => 'ETL, Data Modeling, Star Schema, Snowflake Schema, OLAP, Pentaho, SQL Server, PostgreSQL, MySQL, Power BI, Looker Studio, Data Integration, Reporting, Business Intelligence, Data Pipeline',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK234008 - Pemrograman Web Lanjut
            [
                'id_matkul'   => 'MK234008',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Web Lanjut',
                'keahlian'    => 'Laravel, React.js, Next.js, Vue.js, Node.js / Express, REST API, Inertia.js, Tailwind CSS, MySQL, PostgreSQL, Git & GitHub, Docker, Postman, Authentication, Authorization, API Integration',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK234007 - Analisis dan Perancangan Sistem Informas
            [
                'id_matkul'   => 'MK234007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis dan Perancangan Sistem Informas',
                'keahlian'    => 'Analisis Sistem, Perancangan Sistem, UML Modeling, ERD, DFD, Use Case Diagram, BPMN, Analisis Proses Bisnis, Dokumentasi Teknis, Draw.io / Lucidchart, Feasibility Study, System Design',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK234006 - Data Mining
            [
                'id_matkul'   => 'MK234006',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Data Mining',
                'keahlian'    => 'Machine Learning, Klasifikasi, Clustering, Regresi, Association Rule, Scikit-learn, Python, Pandas, NumPy, Matplotlib / Seaborn, Jupyter Notebook, Preprocessing Data, Feature Engineering, Decision Tree, Random Forest, K-Means',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK235006 - Penjaminan Mutu Perangkat Lunak
            [
                'id_matkul'   => 'MK235006',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Penjaminan Mutu Perangkat Lunak',
                'keahlian'    => 'Software Testing, Manual Testing, Automation Testing, Test Case, Bug Reporting, Playwright, Selenium, Postman, API Testing, Regression Testing, Black Box Testing, White Box Testing, Quality Assurance, Dokumentasi Testing',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK235007 - Pemrograman Mobile
            [
                'id_matkul'   => 'MK235007',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Pemrograman Mobile',
                'keahlian'    => 'Flutter, Dart, Android Studio, Firebase, REST API, SQLite, React Native, Mobile UI Design, Figma, Git & GitHub, State Management, Notifikasi Push, Multi-platform Development',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK235002 - Audit Sistem Informasi
            [
                'id_matkul'   => 'MK235002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Audit Sistem Informasi',
                'keahlian'    => 'IT Governance, Audit IT, COBIT Framework, Analisis Risiko, Keamanan Informasi, Dokumentasi Audit, ISO 27001, Compliance, Manajemen Kebijakan IT, Risk Assessment, Kontrol Internal',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // MK234002 - Statistika
            [
                'id_matkul'   => 'MK234002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Statistika',
                'keahlian'    => 'Statistika Deskriptif, Distribusi Data, Uji Hipotesis, Regresi Linier, Korelasi, Python, R, Pandas, NumPy, Matplotlib / Seaborn, Excel, Visualisasi Data, Analisis Data, Probability',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            // MK232002 - Analisis Proses Bisnis
            [
                'id_matkul'   => 'MK232002',
                'prodi_id'    => 'JTI002',
                'nama_matkul' => 'Analisis Proses Bisnis',
                'keahlian'    => 'Business Process Analysis, BPMN, Flowchart Bisnis, Identifikasi Kebutuhan, Analisis Kebutuhan, Draw.io / Lucidchart, Dokumentasi Proses, Microsoft Office, Stakeholder Analysis, Value Chain Analysis, ERD',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ];

        DB::table('mata_kuliah_models')->insert($mataKuliah);
    }
}