<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = ['IF', 'SI', 'TI'];
        foreach ($prodi as $value) {
            \App\Models\Prodi::create([
                'prodi' => $value
            ]);
        }
    }
}
