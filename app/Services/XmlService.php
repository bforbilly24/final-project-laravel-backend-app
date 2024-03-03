<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class XmlService
{
    public function parseXml($filePath)
    {
        try {
            $xml = simplexml_load_string(Storage::get($filePath));
            return $xml;
        } catch (\Exception $e) {
            // Handle parsing errors gracefully
            return null;
        }
    }
}
