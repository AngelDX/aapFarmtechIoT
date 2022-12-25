<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Category::create([
            'name'=>'ACTUALIDAD'
        ]);
        Category::create([
            'name'=>'CLIMA'
        ]);
        Category::create([
            'name'=>'SIEMBRA'
        ]);
        Category::create([
            'name'=>'COSECHA'
        ]);
    }
}
