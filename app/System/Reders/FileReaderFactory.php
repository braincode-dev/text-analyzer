<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/25/22
 * Time: 8:20 PM
 */

namespace App\System\Reders;


class FileReaderFactory
{
    public static function build(string $fileType)
    {
        switch ($fileType){
            case 'xml':
            case 'txt':
            case 'html':
                return new UniversalFileReader();
        }

        throw new \Exception('Yor file not supported');
    }
}