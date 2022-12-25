<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Place::create([
            'name'=>'Invernadero',
            'type'=>'Interior',
        ]);
        Place::create([
            'name'=>'Patio ASPAAH',
            'type'=>'Exterior',
        ]);
    }
}
