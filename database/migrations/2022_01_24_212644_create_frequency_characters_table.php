<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequencyCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequency_characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('analyzer_result_id');
            $table->string('characters')->nullable();
            $table->string('frequency')->nullable();
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
        Schema::dropIfExists('frequency_characters');
    }
}
