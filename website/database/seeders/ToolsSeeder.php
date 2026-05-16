<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolsSeeder extends Seeder
{
    public function run()
    {
        $tools = [
            'AWS',
            'Adobe XD',
            'AI',
            'Canva',
            'Cisco',
            'CI/CD',
            'C#',
            'Dart',
            'Docker',
            'draw.io',
            'ELK Stack',
            'ERP-BPM Platform',
            'Excel',
            'Express.js',
            'FastAPI',
            'Figma',
            'Flutter',
            'GCP',
            'Git',
            'GitHub',
            'Go',
            'Google Analytics',
            'Google Sheets',
            'Grafana',
            'GraphQL',
            'Hyperledger Fabric',
            'IoT Platform',
            'JavaScript',
            'Laravel',
            'Leaflet',
            'Linux Server',
            'LLM Tools',
            'Looker Studio',
            'Matplotlib',
            'Microsoft Excel',
            'Microsoft Office',
            'Mikrotik',
            'MySQL',
            'n8n',
            'Next.js',
            'Nmap',
            'Node.js',
            'OpenLayers',
            'PHP',
            'Playwright',
            'PostGIS',
            'PostgreSQL',
            'Postman',
            'Power BI',
            'Prometheus',
            'PyTorch',
            'Python',
            'React',
            'REST API',
            'Ruby',
            'Selenium',
            'SIEM',
            'Social Media Analytics Tools',
            'Splunk',
            'SQL',
            'SQL Server',
            'Tableau',
            'TensorFlow',
            'Unity',
            'VB.NET',
            'Visual Basic',
            'Vue.js',
            'WebSocket',
            'Wireshark',
            'WordPress',
        ];

        foreach ($tools as $index => $tool) {
            DB::table('tools')->insert([
                'tools_id'   => 'T' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama_tools' => $tool,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
