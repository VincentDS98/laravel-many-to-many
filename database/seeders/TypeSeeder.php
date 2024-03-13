<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Type;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;


class TypeSeeder extends Seeder
{
    
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Type::truncate();
        });

        $allTypes = [
            'HTML',
            'CSS',
            'JavaScript',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];



        foreach ($allTypes as $singleType) {

            

            $type = Type::create([
                'title' => $singleType,
                'slug'=> str()->slug($singleType)
            ]);
        }
    }
}