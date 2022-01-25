<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/24/22
 * Time: 8:05 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FrequencyCharacters extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'analyzer_result_id',
        'characters',
        'frequency',
    ];
}