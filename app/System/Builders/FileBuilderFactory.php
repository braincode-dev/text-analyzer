<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/25/22
 * Time: 8:50 PM
 */

namespace App\System\Builders;


class FileBuilderFactory
{
    public static function getBuilder(string $fileType)
    {
        switch ($fileType){
            case 'xml':
                return new XMLFileBuilder();
            case 'csv':
                return new CSVFileBuilder();
            case 'xlsx':
                return new XLSXFileBuilder();
        }

        throw new \Exception('Your file not supported');
    }
}