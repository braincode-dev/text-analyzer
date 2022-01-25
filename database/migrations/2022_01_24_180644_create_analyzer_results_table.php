<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyzerResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyzer_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash');
            $table->float('time');
            $table->integer('number_characters');
            $table->integer('number_words');
            $table->integer('number_sentences');
            $table->integer('average_word_length');
            $table->integer('average_number_words');
            $table->integer('palindrome_words');
            $table->text('top_palindrome_words');
            $table->text('is_palindrome_string');
            $table->text('reversed_text');
            $table->text('reversed_word');
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
        Schema::dropIfExists('analyzer_results');
    }
}
