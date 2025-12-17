<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Wisata;
use App\Models\Galeri;

class WisataSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User Admin (Jika belum ada)
        // Kita cek dulu apakah user dengan username 'Mindes' sudah ada (dari UserSeeder)
        $user = User::where('username', 'Mindes')->first();
        
        // Jika belum ada, buat user baru sebagai backup
        if (!$user) {
            $user = User::create([
                'username' => 'admin_wisata',
                'password' => bcrypt('password'),
            ]);
        }

        $katAlam = Kategori::firstOrCreate(['nama_kategori' => 'Alam']);
        $katEdukasi = Kategori::firstOrCreate(['nama_kategori' => 'Edukasi']);
        $katBudaya = Kategori::firstOrCreate(['nama_kategori' => 'Budaya']);
        $katReligi = Kategori::firstOrCreate(['nama_kategori' => 'Religi']);
        $katKuliner = Kategori::firstOrCreate(['nama_kategori' => 'Kuliner']);

        $daftarWisata = [
            [
                'kategori_id' => $katAlam->id_kategori,
                'nama' => 'Goa Lawa Purbalingga',
                'harga' => 20000,
                'instagram' => '@goalawa',
                'notelp' => '081234567890',
                'deskripsi' => "Lokasi: Desa Siwarak, Karangreja, Purbalingga.\n\nMerupakan gua kelelawar alami sepanjang 1,5 km yang instagramable. Dilengkapi wahana seperti outbound dan menjadi habitat ribuan kelelawar. Udara di sini sangat sejuk dan cocok untuk wisata keluarga.",
                'gambar' => 'goalawa.jpg' 
            ],
            [
                'kategori_id' => $katEdukasi->id_kategori,
                'nama' => "D'Las Lembah Asri",
                'harga' => 10000,
                'instagram' => '@dlas_serang',
                'notelp' => '085678901234',
                'deskripsi' => "Lokasi: Serang, Kec. Karangreja, Purbalingga.\n\nDesa wisata di lereng Gunung Slamet dengan udara sejuk pegunungan. Menawarkan hamparan rumput hijau, taman bunga yang indah, dan kebun stroberi. Sangat cocok untuk edukasi anak-anak.",
                'gambar' => 'dlas.jpg'
            ],
            [
                'kategori_id' => $katAlam->id_kategori,
                'nama' => 'Telaga Situ Tirta Marta',
                'harga' => 5000,
                'instagram' => '@tirtamarta_official',
                'notelp' => '081345678901',
                'deskripsi' => "Lokasi: Karangcegak, Kutasari, Purbalingga.\n\nTelaga dengan air yang sangat jernih bersumber dari mata air alami. Pengunjung bisa berenang, foto underwater, atau sekadar bersantai menikmati suasana asri di sekitar telaga.",
                'gambar' => 'tirtamarta.jpg'
            ],
            [
                'kategori_id' => $katAlam->id_kategori,
                'nama' => 'Curug Gede',
                'harga' => 10000,
                'instagram' => '@curuggede_baturraden',
                'notelp' => null,
                'deskripsi' => "Lokasi: Ketenger, Baturraden, Banyumas.\n\nAir terjun indah dengan ketinggian sekitar 50 meter dan kolam alami yang luas di bawahnya. Cocok untuk Anda yang hobi trekking ringan dan menikmati gemericik air terjun.",
                'gambar' => 'curuggede.jpg'
            ],
            [
                'kategori_id' => $katAlam->id_kategori,
                'nama' => 'Pantai Menganti',
                'harga' => 20000,
                'instagram' => '@mengantibeach',
                'notelp' => '089876543210',
                'deskripsi' => "Lokasi: Desa Karangduwur, Ayah, Kebumen.\n\nPantai dengan pasir putih yang bersih dan dikelilingi tebing karst yang memukau. Sering disebut sebagai 'Selandia Baru'-nya Indonesia karena pemandangannya yang eksotis.",
                'gambar' => 'menganti.jpg'
            ],
        ];

        foreach ($daftarWisata as $data) {
            $wisata = Wisata::create([
                'id_user' => $user->id_user,
                'id_kategori' => $data['kategori_id'],
                'nama_wisata' => $data['nama'],
                'deskripsi' => $data['deskripsi'],
                'harga' => $data['harga'],
                'instagram' => $data['instagram'],
                'notelp' => $data['notelp'],
            ]);

            Galeri::create([
                'id_wisata' => $wisata->id_wisata,
                'filename' => $data['gambar']
            ]);
        }
    }
}