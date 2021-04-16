<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'user_id' => '2',
            'message' => 'What is Lorem Ipsum?',
        ]);
        Question::create([
            'user_id' => '2',
            'message' => 'Where does it come from?',
        ]);
        Question::create([
            'user_id' => '3',
            'message' => 'Why do we use it?',
        ]);
        Question::create([
            'user_id' => '3',
            'message' => 'Where can I get some?',
        ]);
    }
}
