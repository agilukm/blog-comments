<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('website', 50);
            $table->string('email', 50);
            $table->longText('message');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('post_id')->unsigned();              
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
        Schema::dropIfExists('comments');
    }
}

