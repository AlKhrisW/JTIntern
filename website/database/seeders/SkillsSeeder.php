<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Analisis Data',
            'Analisis Sistem',
            'Backend Development',
            'CI/CD Pipeline',
            'Cloud Computing',
            'Code Review',
            'Communication Skill',
            'Cyber Security',
            'Data Processing',
            'Database Management',
            'Debugging',
            'Distributed Systems',
            'Dokumentasi Sistem',
            'ETL',
            'Frontend Development',
            'GIS',
            'IoT Development',
            'JavaScript Programming',
            'Logika Pemrograman',
            'Machine Learning',
            'Microservices',
            'Mobile Development',
            'Pemrograman Dasar',
            'Problem Solving',
            'Project Management',
            'Public Speaking',
            'Python Programming',
            'Quality Assurance',
            'REST API Development',
            'Smart Contract Development',
            'Software Testing',
            'System Integration',
            'Team Collaboration',
            'UI/UX Design',
            'Version Control',
            'Web Development',
            'WebGIS',
        ];

        foreach ($skills as $index => $skill) {
            DB::table('skills')->insert([
                'skill_id'   => 'SK' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama_skill' => $skill,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
