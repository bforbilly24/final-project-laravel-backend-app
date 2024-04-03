<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

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
}
