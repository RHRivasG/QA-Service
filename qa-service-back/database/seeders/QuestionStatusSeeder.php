<?php

namespace Database\Seeders;

use App\Models\QuestionStatus;
use Illuminate\Database\Seeder;

class QuestionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionStatus::create([
            'question_id' => '1',
            'status' => 'pending',
            'initial_date' => date('Y-m-d H:i:s'),
            'final_date' => date('Y-m-d H:i:s')

        ]);
        QuestionStatus::create([
            'question_id' => '1',
            'status' => 'accepted',
            'initial_date' => date('Y-m-d H:i:s'),
            'answer'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ]);
        QuestionStatus::create([
            'question_id' => '2',
            'status' => 'pending',
            'initial_date' => date('Y-m-d H:i:s')
        ]);
        QuestionStatus::create([
            'question_id' => '3',
            'status' => 'pending',
            'initial_date' => date('Y-m-d H:i:s')
        ]);
        QuestionStatus::create([
            'question_id' => '4',
            'status' => 'pending',
            'initial_date' => date('Y-m-d H:i:s')
        ]);
    }
}
