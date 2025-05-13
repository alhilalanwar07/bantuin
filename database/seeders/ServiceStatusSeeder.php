<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'pending',
                'color' => '#FFC107', // Kuning
                'description' => 'Permintaan layanan baru yang belum diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'pickup',
                'color' => '#FF9800', // Oranye
                'description' => 'Penyedia layanan sedang dalam perjalanan ke lokasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'negotiating',
                'color' => '#9C27B0', // Ungu
                'description' => 'Sedang dalam proses negosiasi harga dan detail layanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'processing',
                'color' => '#2196F3', // Biru
                'description' => 'Permintaan sedang diproses oleh penyedia layanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'in_progress',
                'color' => '#03A9F4', // Biru Muda
                'description' => 'Pekerjaan sedang berlangsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'completed',
                'color' => '#4CAF50', // Hijau
                'description' => 'Layanan telah selesai dilakukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'cancelled',
                'color' => '#F44336', // Merah
                'description' => 'Layanan dibatalkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('service_statuses')->insert($statuses);
    }
}