<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * TODO: Add initial data.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user_presence', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->integer('age');
            $table->text('bio');
            $table->string('avatar');
            $table->string('video');
            $table->integer('presence_id')
                ->unsigned()
                ->nullable();
            $table->integer('type_id')
                ->unsigned()
                ->nullable();
            $table->integer('status_id')
                ->unsigned()
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('presence_id')
                ->references('id')
                ->on('user_presence');
            $table->foreign('type_id')
                ->references('id')
                ->on('user_type');
                $table->foreign('status_id')
                ->references('id')
                ->on('user_status');
        });

        DB::table('user')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => app('hash')->make('admin'),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
        Schema::drop('user_status');
        Schema::drop('user_type');
        Schema::drop('user_presence');
    }
}
