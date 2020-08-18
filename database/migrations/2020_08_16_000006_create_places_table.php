<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denloc');
            $table->string('codp');
            $table->string('sirsup');
            $table->integer('tip');
            $table->integer('zona');
            $table->integer('niv');
            $table->integer('med');
            $table->integer('regiune');
            $table->integer('fsj')->nullable();
            $table->string('FS2')->nullable();
            $table->string('FS3')->nullable();
            $table->integer('fsl')->nullable();
            $table->string('rang')->nullable();
            $table->string('fictiv')->nullable();
        });
    }
}