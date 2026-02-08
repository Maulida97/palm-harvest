<?php

namespace Database\Seeders;

use App\Models\FineCategory;
use Illuminate\Database\Seeder;

class FineCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'code' => 0,
                'description' => 'Tidak Ada Denda',
                'fine_pemanen_old' => 0,
                'fine_pemanen_new' => 0,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 0,
                'fine_mandor_1' => 0,
                'fine_asisten' => 0,
            ],
            [
                'code' => 1,
                'description' => 'Memotong buah mentah',
                'fine_pemanen_old' => 10000,
                'fine_pemanen_new' => 20000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 7000,
                'fine_mandor_1' => 4000,
                'fine_asisten' => 4000,
            ],
            [
                'code' => 2,
                'description' => 'Buah masak tidak dipanen',
                'fine_pemanen_old' => 10000,
                'fine_pemanen_new' => 20000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 7000,
                'fine_mandor_1' => 5000,
                'fine_asisten' => 5000,
            ],
            [
                'code' => 3,
                'description' => 'Buah masak tidak dikeluarkan ke TPH',
                'fine_pemanen_old' => 10000,
                'fine_pemanen_new' => 20000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 7000,
                'fine_mandor_1' => 5000,
                'fine_asisten' => 5000,
            ],
            [
                'code' => 4,
                'description' => 'Buah matahari',
                'fine_pemanen_old' => 1500,
                'fine_pemanen_new' => 5000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 1000,
                'fine_mandor_1' => 1000,
                'fine_asisten' => 1000,
            ],
            [
                'code' => 5,
                'description' => 'Brondol harus dikutip bersih di piringan saat panen',
                'fine_pemanen_old' => 3000,
                'fine_pemanen_new' => 5000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 1000,
                'fine_mandor_1' => 1000,
                'fine_asisten' => 1000,
            ],
            [
                'code' => 6,
                'description' => 'Brondolan segar dibuang ke gawangan, parit dan pasar pikul',
                'fine_pemanen_old' => 15000,
                'fine_pemanen_new' => 20000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 15000,
                'fine_mandor_1' => 7000,
                'fine_asisten' => 7000,
            ],
            [
                'code' => 7,
                'description' => 'Buah tidak disusun rapi di TPH',
                'fine_pemanen_old' => 1000,
                'fine_pemanen_new' => 5000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 1000,
                'fine_mandor_1' => 1000,
                'fine_asisten' => 1000,
            ],
            [
                'code' => 8,
                'description' => 'Tangkai buah tidak dipotong rapat/mepet (max 2 cm) dan potongan gagang buah tidak dibuang di TPH',
                'fine_pemanen_old' => 1000,
                'fine_pemanen_new' => 5000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 1000,
                'fine_mandor_1' => 1000,
                'fine_asisten' => 1000,
            ],
            [
                'code' => 9,
                'description' => 'Pelepah sengkleh, pelepah tidak disusun rapi atau U shape',
                'fine_pemanen_old' => 1000,
                'fine_pemanen_new' => 5000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 2000,
                'fine_mandor_1' => 2000,
                'fine_asisten' => 2000,
            ],
            [
                'code' => 10,
                'description' => 'Karyawan dalam kondisi sehat dan tidak masuk bekerja tanpa keterangan kepada pimpinan divisi (bagi karyawan yang menginap di Emplasment)',
                'fine_pemanen_old' => 50000,
                'fine_pemanen_new' => 100000,
                'fine_kerani_panen' => 0,
                'fine_mandor_panen' => 5000,
                'fine_mandor_1' => 5000,
                'fine_asisten' => 5000,
            ],
            [
                'code' => 11,
                'description' => 'Buah mentah terkirim ke PKS tanpa remark pada SPTBS',
                'fine_pemanen_old' => 0,
                'fine_pemanen_new' => 0,
                'fine_kerani_panen' => 10000,
                'fine_mandor_panen' => 0,
                'fine_mandor_1' => 5000,
                'fine_asisten' => 5000,
            ],
            [
                'code' => 12,
                'description' => 'Brondolan di TPH tidak dikutip bersih dihari yang sama',
                'fine_pemanen_old' => 0,
                'fine_pemanen_new' => 0,
                'fine_kerani_panen' => 5000,
                'fine_mandor_panen' => 0,
                'fine_mandor_1' => 2500,
                'fine_asisten' => 2500,
            ],
        ];

        foreach ($categories as $category) {
            FineCategory::create($category);
        }
    }
}
