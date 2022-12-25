<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model{
    use HasFactory;
    protected $guerded=['id'];

    public function sensors(){
        return $this->hasMany(Sensor::class);
    }
}
