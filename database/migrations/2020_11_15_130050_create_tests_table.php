<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_disc')->unique();
            $table->foreign('id_disc')
                ->references('id')
                ->on('disciplines')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('name');
            $table->string('author');
            $table->integer('status')->default('1');
            $table->integer('number');
            $table->float('testtime')->default('10');
            $table->integer('id_group_test');

            $table->timestamps();
        });

        Schema::create('test_topics', function (Blueprint $table) {
            $table->integer('id_topic')->index();
            $table->foreign('id_topic')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('id_test')->index();
            $table->foreign('id_test')
                ->references('id')
                ->on('tests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('test_users', function (Blueprint $table) {
            $table->integer('id_test')->index();
            $table->foreign('id_test')
                ->references('id')
                ->on('tests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('id_group')->index();
            $table->foreign('id_group')
                ->references('id')
                ->on('groups')
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
        Schema::dropIfExists('tests');
        Schema::dropIfExists('test_topic');
        Schema::dropIfExists('test_users');
    }
}
