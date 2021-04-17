<?php namespace App\Services;

use App\Interfaces\QuestionServiceInterface;
use App\Models\Question;

class QuestionService implements QuestionServiceInterface
{
    public function showAccepted()
    {
        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('question_status AS qsp','questions.id','=','qsp.question_id')
            ->join('question_status AS qsa','questions.id','=','qsa.question_id')
            ->where('qsp.status','pending')
            ->whereNotNull('qsp.final_date')
            ->where('qsa.status','accepted')
            ->whereNull('qsa.final_date')
            ->get(['users.username',
                    'questions.message',
                    'qsp.initial_date AS question_date',
                    'qsa.status',
                    'qsa.initial_date AS answer_date',
                    'qsa.answer' ]);
        return $questions;
    }

    public function showPending()
    {
        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('question_status','questions.id','=','question_status.question_id')
            ->where('question_status.status','pending')
            ->whereNull('question_status.final_date')
            ->get(['users.username',
                    'questions.message',
                    'question_status.status',
                    'question_status.initial_date AS question_date']);
        return $questions;
    }

    public function showDenied()
    {
        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('question_status','questions.id','=','question_status.question_id')
            ->where('question_status.status','denied')
            ->whereNull('question_status.final_date')
            ->get(['users.username',
                    'questions.message',
                    'question_status.status',
                    'question_status.initial_date']);
        return $questions;

    }

}
