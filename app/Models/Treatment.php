<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    public function seances(){
        return $this->hasMany(Seance::class,'id_treatment');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
