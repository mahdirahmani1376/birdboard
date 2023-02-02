<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
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
        $mahdi = \App\Models\User::factory()->create([
            'name' => 'mahdi rahmani',
            'email' => 'rahmanimahdi16@gmail.com',
            'password' => \Hash::make('Ma13R18@'),
        ]);

        Project::factory(2)->create(['owner_id' => $mahdi->id]);
        $this->call([
//            ProjectSeeder::class,
        ]);
    }
}
