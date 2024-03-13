<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Technology;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    
    public function run(): void
    {
        
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        $allTechnologies = [
            'News',
            'Updates',
            'Release',
            'Technology',
            'Web',
            'Software',
            'Hardware',
            'Blockchain',
            'AI',
            'Machine Learning',
            'ChatGPT',
        ];

        foreach ($allTechnologies as $singleTechnology) {
            $technology = Technology::create([
                'title' => $singleTechnology,
                'slug' => Str::slug($singleTechnology)
            ]);
        }
    }

}