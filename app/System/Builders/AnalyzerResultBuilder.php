<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/24/22
 * Time: 9:15 PM
 */

namespace App\System\Builders;


use App\Models\AnalyzerResults;

class AnalyzerResultBuilder
{
    public static function builder(int $id) : array
    {
        $dataResultArr = AnalyzerResults::with('getFrequencyCharacters')->findOrFail($id)->toArray();
        return $dataResultArr;
    }
}