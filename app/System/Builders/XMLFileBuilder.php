<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 1/25/22
 * Time: 9:10 PM
 */

namespace App\System\Builders;

use Spatie\ArrayToXml\ArrayToXml;

class XMLFileBuilder extends FileBuilder
{
    public function build(array $data)
    {
        $name = $this->getFileName('xml');

        $res = ArrayToXml::convert($data, 'analyzer-result');

        $data = new \DOMDocument();
        $data->preserveWhiteSpace = false;
        $data->loadXML($res);
        $data->save($name);

        return $name;
    }
}