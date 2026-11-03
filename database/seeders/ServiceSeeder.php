<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed layanan awal MotoCare.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Ganti Oli',
                'description' => 'Ganti oli adalah servis rutin terpenting untuk setiap motor. Oli mesin berfungsi sebagai pelumas untuk semua komponen dalam mesin. Penggantian oli dilakukan dengan spesifikasi oli dan jumlah yang tepat.',
                'image' => 'images/ganti-oli.png',
                'estimated_price' => 50000,
            ],
            [
                'name' => 'Tune Up',
                'description' => 'Tune up adalah prosedur perawatan rutin pada kendaraan yang bertujuan untuk memeriksa, membersihkan, dan menyetel ulang berbagai komponen mesin agar performanya kembali optimal, bertenaga, dan hemat bahan bakar.',
                'image' => 'images/tune-up.png',
                'estimated_price' => 150000,
            ],
            [
                'name' => 'Bore Up',
                'description' => 'Bore up adalah proses modifikasi mesin yang dilakukan dengan memperbesar diameter silinder dan piston untuk meningkatkan kapasitas (cc) dan tenaga mesin.',
                'image' => 'images/bore-up.png',
                'estimated_price' => 750000,
            ],
            [
                'name' => 'Ganti Ban',
                'description' => 'Ban wajib diganti saat tapaknya sudah aus atau telah mencapai batas pemakaian agar keamanan dan kenyamanan tetap terjaga.',
                'image' => 'images/ganti-ban.png',
                'estimated_price' => 250000,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
