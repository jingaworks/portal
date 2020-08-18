<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_2007676')->references('id')->on('categories');
            $table->unsignedInteger('subcategory_id');
            $table->foreign('subcategory_id', 'subcategory_fk_2007677')->references('id')->on('subcategories');
            $table->unsignedInteger('region_id');
            $table->foreign('region_id', 'region_fk_2006676')->references('id')->on('regions');
            $table->unsignedInteger('place_id');
            $table->foreign('place_id', 'place_fk_2006677')->references('id')->on('places');
            $table->unsignedInteger('profile_id')->nullable();
            $table->foreign('profile_id', 'profile_id_fk_2007678')->references('id')->on('profiles');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2006678')->references('id')->on('users');
        });
    }
}