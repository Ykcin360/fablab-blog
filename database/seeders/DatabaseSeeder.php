<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Gender;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Gender::factory()->createMany([
            ['name' => 'homme'],
            ['name' => 'femme']
        ]);

        State::factory()->createMany([
            ['name' => 'created'],
            ['name' => 'deleted'],
            ['name' => 'inactive']
        ]);

        Category::factory()->createMany([
            ['name' => 'activité'],
            ['name' => 'tutoriel'],
            ['name' => 'vente de produits']
        ]);

        User::factory()->create([
            'first_name' => 'Fablab',
            'last_name' => 'Admin',
            'is_admin' => true,
            'email' => 'fablab.blog@gmail.com',
            'password' => bcrypt('adminpassword'),
        ]);

        User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
