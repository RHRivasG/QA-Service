<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_status', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->enum('status',['accepted','pending','denied']);
            $table->text('answer')->nullable();
            $table->timestamp('initial_date');
            $table->timestamp('final_date')->nullable();

            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_status');
    }
}
