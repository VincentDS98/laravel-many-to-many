<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Project;
use App\Models\Type;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
   
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 10; $i++) {

            
            $randomType = Type::inRandomOrder()->first();

            $title = fake()->sentence();
            $slug = Str::slug($title);

            $project = Project::create([
                'title' => $title,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'type_id' => $randomType->id,  
                'status' => fake()->boolean(),
            ]);
        }
    }
}