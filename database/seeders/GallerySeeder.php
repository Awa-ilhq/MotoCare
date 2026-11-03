<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Seed galeri awal MotoCare.
     */
    public function run(): void
    {
        $galleries = [
            [
                'image' => 'images/galeri1.png',
                'caption' => 'Servis rutin motor di MotoCare',
            ],
            [
                'image' => 'images/galeri2.png',
                'caption' => 'Perawatan mesin oleh teknisi berpengalaman',
            ],
            [
                'image' => 'images/galeri3.png',
                'caption' => 'Area kerja bengkel yang bersih dan rapi',
            ],
            [
                'image' => 'images/galeri4.png',
                'caption' => 'Peralatan servis modern',
            ],
            [
                'image' => 'images/galeri5.png',
                'caption' => 'Penggantian oli dengan spesifikasi tepat',
            ],
            [
                'image' => 'images/galeri6.png',
                'caption' => 'Hasil servis yang rapi dan memuaskan',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['image' => $gallery['image']],
                $gallery + ['is_active' => true]
            );
        }
    }
}
