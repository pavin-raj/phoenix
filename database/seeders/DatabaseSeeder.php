<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\Role::create(['name'=>'admin']);
        // \App\Models\Role::create(['name'=>'coordinator']);
        // \App\Models\Role::create(['name'=>'emergency responder']);
        // \App\Models\Role::create(['name'=>'volunteer']);
        // \App\Models\Role::create(['name'=>'citizen']);        

        $this->call([
            UserSeeder::class
        ]);

        Task::factory()->count(10)->create();
    }
}
