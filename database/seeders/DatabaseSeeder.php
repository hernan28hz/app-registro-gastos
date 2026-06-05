<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        foreach (['Alimentos', 'Servicios', 'Transporte', 'Tecnologia', 'Otros'] as $name) {
            Category::create([
                'user_id' => $user->id,
                'name' => $name,
            ]);
        }
    }
}
