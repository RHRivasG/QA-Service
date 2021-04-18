<?php

namespace App\Http\Controllers;

use App\Events\AcceptedEvent;
use App\Interfaces\QuestionServiceInterface;
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

    public function showAccepted(QuestionServiceInterface $questionService){
        event(new AcceptedEvent($questionService));
        return [
            'message' => 'OK'
        ];
    }

    public function showPending(QuestionServiceInterface $questionService){
        return $questionService->showPending();
    }

    public function showDenied(QuestionServiceInterface $questionService){
        return $questionService->showDenied();
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
