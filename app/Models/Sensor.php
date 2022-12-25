<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model{
    use HasFactory;
    protected $guerded=['id'];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }
}
