<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    public function service(){
        return $this->belongsTo(Service::class,'id_service');
    }
    public function treatement(){
        return $this->belongsTo(Treatment::class,'id_treatment');
    }
}
