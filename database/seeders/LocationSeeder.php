<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Location::create([
            'nombrelugar'=>'Finca ASPAAH',
            'region'=>'Puno',
            'provincia'=>'San Román',
            'distrito'=>'Juliaca',
            'descripcion'=>'Salida Arequipa Kilometro 15 - Yocara',
        ]);
    }
}
