<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStatus extends Model
{
    use HasFactory;

    //Many to One

    public function question(){
        return $this->belongsTo(Question::class);
    }

    protected $table = 'question_status';
}
