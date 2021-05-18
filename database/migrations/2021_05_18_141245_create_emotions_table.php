<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("timestamp");
            $table->unsignedDecimal("x", 15, 12);
            $table->unsignedDecimal("y", 15, 12);
            $table->unsignedInteger('anger')->nullable();
            $table->unsignedInteger('contempt')->nullable();
            $table->unsignedInteger('disgust')->nullable();
            $table->unsignedInteger('fear')->nullable();
            $table->unsignedInteger('joy')->nullable();
            $table->unsignedInteger('sadness')->nullable();
            $table->unsignedInteger('surprise')->nullable();
            $table->unsignedInteger('valence')->nullable();
            $table->unsignedInteger('engagement')->nullable();
            $table->foreignId("page_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emotions');
    }
}
