<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class XmlService
{
    public function parseXml($filePath)
    {
        try {
            $xmlString = Storage::get($filePath);
            $xmlObject = simplexml_load_string($xmlString);
            $json = json_encode($xmlObject);
            $array = json_decode($json, true);
            return response()->json($array);
        } catch (\Exception $e) {
            return null;
        }
    }

    // private function xmlToArray(SimpleXMLElement $xml)
    // {
    //     $array = (array)$xml;

    //     foreach (array_slice($array, 0) as $key => $value) {
    //         if (strlen($key) > 20) {
    //             unset($array[$key]);
    //         } else if (is_object($value) && get_class($value) == 'SimpleXMLElement') {
    //             $array[$key] = $this->xmlToArray($value);
    //         }
    //     }

    //     return $array;
    // }
}
