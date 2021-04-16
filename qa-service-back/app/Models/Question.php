<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    //Many to One

    public function status(){
        return $this->hasMany(QuestionStatus::class);
    }

    //One to Many

    public function user(){
         return $this->belongsTo(User::class); 
    }
}
