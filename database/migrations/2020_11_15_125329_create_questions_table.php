<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->longText('description');
            $table->integer('id_topic')->index();

            $table->foreign('id_topic')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('group_electrical');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->index();
            $table->integer('id_question')->index();

            $table->foreign('id_question')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->longText('description_answer');
            $table->integer('correct')->default('0');
            $table->integer('id_topic')->index();
            $table->foreign('id_topic')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
    }
}
