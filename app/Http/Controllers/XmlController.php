<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\XmlService;

class XmlController extends Controller
{
    protected $xmlService;

    public function __construct(XmlService $xmlService)
    {
        $this->xmlService = $xmlService;
    }

    public function getXmlData()
    {
        $filePath = 'xml/data-1.xml';
        $xmlData = $this->xmlService->parseXml($filePath);
        
        if ($xmlData) {
            return response()->json($xmlData);
        } else {
            return response()->json(['error' => 'Failed to read XML file.'], 500);
        }
    }
}
