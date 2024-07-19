<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Posting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Comment::factory(100)->create();

        // Posting::factory(100)->video()->create();

        $anggara = User::factory()->create([
            'name' => 'anggara saputra',
            'username' => 'anggara_s',
            'email' => 'anggara@gmail.com',
            'password' => bcrypt('angga123')
        ]);
        
        // $wiwi = User::factory()->create([
        //     'name' => 'Neng wiwi',
        //     'username' => 'Neng_wiwi',
        //     'email' => 'wiwi@gmail.com',
        //     'password' => bcrypt('nengwiwi123')
        // ]);
        
        $wiwi = User::factory()->create([
            'name' => 'Mendi Roy',
            'username' => 'M_roy',
            'email' => 'roy@gmail.com',
            'password' => bcrypt('ujicoba')
        ]);

        User::factory(10)->create();

    }
}
