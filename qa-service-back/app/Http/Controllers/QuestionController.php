<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionStatus;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:question.create')->only('doQuestion');
        $this->middleware('can:question.pending')->only('showPending');
        $this->middleware('can:question.denied')->only('showDenied');
        $this->middleware('can:question.answer')->only('doAnswer');
        $this->middleware('can:question.deny')->only('denyQuestion');
    }

    public function showAccepted(){
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

    public function showPending(){
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

    public function showDenied(){
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

    public function doQuestion(Request $request){

        $question = $request->all();
        $question['user_id'] = $request->user()->id;

        $id = Question::create($question)->id;

        QuestionStatus::create([
            'question_id' => $id,
            'status' => 'pending',
            'initial_date' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'res' => true,
            'message' => "Question sent!"
        ], 200);
    }

    public function doAnswer(Request $request){

        QuestionStatus::where('question_id',$request->question_id)
            ->where('status','pending')
            ->where('initial_date',$request->question_date)
            ->update(['final_date'=>date('Y-m-d H:i:s')]);

        QuestionStatus::create([
            'question_id'=>$request->question_id,
            'status'=>'accepted',
            'initial_date', date('Y-m-d H:i:s'),
            'answer'=>$request->answer
        ]);

        return response()->json([
            'res' => true,
            'message' => "Answer sent!"
        ], 200);
    }

    public function denyQuestion(Request $request){
        QuestionStatus::where('question_id',$request->question_id)
            ->where('status','pending')
            ->where('initial_date',$request->question_date)
            ->update(['final_date'=>date('Y-m-d H:i:s')]);

        QuestionStatus::create([
            'question_id'=>$request->question_id,
            'status'=>'denied',
            'initial_date', date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'res' => true,
            'message' => "Question denied!"
        ], 200);

    }
}
