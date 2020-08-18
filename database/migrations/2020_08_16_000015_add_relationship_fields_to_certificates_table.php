<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCertificatesTable extends Migration
{
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedInteger('profile_id')->nullable();
            $table->foreign('profile_id', 'profile_id_fk_2007778')->references('id')->on('profiles');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2006421')->references('id')->on('users');
            $table->unsignedInteger('region_id');
            $table->foreign('region_id', 'region_fk_2006434')->references('id')->on('regions');
            $table->unsignedInteger('place_id');
            $table->foreign('place_id', 'place_fk_2006435')->references('id')->on('places');
        });
    }
}