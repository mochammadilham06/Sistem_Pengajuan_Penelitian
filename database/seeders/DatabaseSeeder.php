<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProdiSeeder::class,
        ]);

        $role = ['Admin', 'Wakil Dekan 1', 'Wakil Dekan 2', 'Staf'];
        foreach ($role as $value) {
            \App\Models\Role::create([
                'name' => $value
            ]);
        }

        \App\Models\User::factory(5)->create();
    }
}
