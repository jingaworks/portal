<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('serie')->unique();
            $table->string('valid_year')->default('2020');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}