<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('surname', '255');
            $table->string('name', '255');
            $table->string('lastname', '255');
            $table->string('gender', '5');
            $table->string('login', '255');
            $table->string('password', '255');
            $table->integer('id_group')->index();
            $table->foreign('id_group')
                ->references('id')
                ->on('groups')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('id_roles')->index();
            $table->foreign('id_roles')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('id_group_electrical');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'surname' => 'Admin',
                'name' => '-',
                'lastname' => '-',
                'gender' => 'муж.',
                'login' => 'Admin',
                'password' => Hash::make('Admin123'),
                'id_group' => 1,
                'id_roles' => 1,
                'id_group_electrical' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
