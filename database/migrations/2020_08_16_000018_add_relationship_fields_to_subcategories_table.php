<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubcategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_2006466')->references('id')->on('categories');
            $table->unsignedInteger('added_by_id');
            $table->foreign('added_by_id', 'added_by_fk_2007466')->references('id')->on('users');
            $table->unsignedInteger('approved_by_id');
            $table->foreign('approved_by_id', 'approved_by_fk_2007466')->references('id')->on('users');
        });
    }
}