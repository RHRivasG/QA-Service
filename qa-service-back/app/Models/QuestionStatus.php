<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStatus extends Model
{
    protected $table = 'question_status';

    protected $fillable = [
        'question_id',
        'status',
        'answer',
        'initial_date',
        'final_date'
    ];

    use HasFactory;

    //Many to One

    public function question(){
        return $this->belongsTo(Question::class);
    }

}
