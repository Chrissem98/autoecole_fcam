<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispensers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moniteur_id');
            $table->foreign('moniteur_id')->references('id')->on('moniteurs')->onDelete('cascade');
            $table->unsignedBigInteger('cour_id');
            $table->foreign('cour_id')->references('id')->on('cours')->onDelete('cascade');
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
        Schema::dropIfExists('dispensers');
    }
};
