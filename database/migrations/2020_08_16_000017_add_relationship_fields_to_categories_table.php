<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedInteger('added_by_id')->nullable();
            $table->foreign('added_by_id', 'added_by_fk_2006473')->references('id')->on('users');
            $table->unsignedInteger('approved_by_id')->nullable();
            $table->foreign('approved_by_id', 'approved_by_fk_2007473')->references('id')->on('users');
        });
    }
}