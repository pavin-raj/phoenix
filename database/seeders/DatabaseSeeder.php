<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::create(['name'=>'admin']);
        \App\Models\Role::create(['name'=>'coordinator']);
        \App\Models\Role::create(['name'=>'emergency responder']);
        \App\Models\Role::create(['name'=>'volunteer']);
        \App\Models\Role::create(['name'=>'citizen']);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
