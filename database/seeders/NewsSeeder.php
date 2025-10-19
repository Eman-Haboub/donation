<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => 'Protect Our Kids.Protect Environment',
                'image' => 'storage/home/Group 118.png',
                'details' => 'We run programs to provide safe spaces, education, and healthcare for children especially those affected by conflict, poverty, or displacement. Our initiatives focus on trauma-informed care, inclusive learning environments, and access to essential medical services. By partnering with local communities and global organizations, we aim to empower every child to grow up with dignity, hope, and the opportunity to thrive.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rule of Law & Human Rights',
                'image' => 'storage/home/13.jpg',
                'details' => 'We promote justice, fairness, and protection of human rights in all our initiatives, striving to empower vulnerable communities, amplify marginalized voices, and ensure equal access to opportunities for all, regardless of background, identity, or circumstance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Reduce Poverty ',
                'image' => 'storage/home/3.jpg',
                'details' => 'Our programs aim to improve livelihoods and reduce poverty in Gaza by providing sustainable economic opportunities, supporting small businesses, enhancing access to education and healthcare, and empowering individuals to build resilient and self-sufficient communities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
