<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2006412')->references('id')->on('users');
            $table->unsignedInteger('region_id');
            $table->foreign('region_id', 'region_fk_2006472')->references('id')->on('regions');
            $table->unsignedInteger('place_id');
            $table->foreign('place_id', 'place_fk_2006471')->references('id')->on('places');
        });
    }
}