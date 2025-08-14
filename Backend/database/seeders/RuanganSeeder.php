<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 1',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);
        
       Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 2',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 3',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 4',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 5',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 6',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 7',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 8',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 9',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat 10',
            'kapasitas' => 10,
            'fasilitas' => 'Proyektor, AC, Whiteboard',
            'lokasi' => 'sudirman',
            'deskripsi' => 'Ruang rapat untuk 10 orang, cocok untuk presentasi kecil.',
            'foto' => 'ruang1.jpg',
        ]);
        
    }
}
