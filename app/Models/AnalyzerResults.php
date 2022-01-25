<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/24/22
 * Time: 8:05 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AnalyzerResults extends Model
{
    public $table = 'analyzer_results';
    public $timestamps = true;

    protected $fillable = [
        'hash',
        'time',
        'number_characters',
        'number_words',
        'number_sentences',
        'average_word_length',
        'average_number_words',
        'palindrome_words',
        'top_palindrome_words',
        'is_palindrome_string',
        'reversed_text',
        'reversed_word',
    ];

    public function getFrequencyCharacters()
    {
        return $this->hasMany(FrequencyCharacters::class, 'analyzer_result_id');
    }
}