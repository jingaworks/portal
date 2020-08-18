<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlacesTable extends Migration
{
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->unsignedInteger('region_id')->nullable();
            $table->foreign('region_id', 'region_fk_2006430')->references('id')->on('regions');
        });
    }
}