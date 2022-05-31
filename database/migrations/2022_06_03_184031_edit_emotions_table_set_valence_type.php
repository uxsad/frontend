<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditEmotionsTableSetValenceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->decimal('anger')->change();
            $table->decimal('contempt')->change();
            $table->decimal('disgust')->change();
            $table->decimal('fear')->change();
            $table->decimal('joy')->change();
            $table->decimal('sadness')->change();
            $table->decimal('surprise')->change();
            $table->decimal('valence')->change();
            $table->decimal('engagement')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->unsignedInteger('anger')->change();
            $table->unsignedInteger('contempt')->change();
            $table->unsignedInteger('disgust')->change();
            $table->unsignedInteger('fear')->change();
            $table->unsignedInteger('joy')->change();
            $table->unsignedInteger('sadness')->change();
            $table->unsignedInteger('surprise')->change();
            $table->unsignedInteger('valence')->change();
            $table->unsignedInteger('engagement')->change();
        });
    }
}
