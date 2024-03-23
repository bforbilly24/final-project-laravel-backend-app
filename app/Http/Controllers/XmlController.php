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

    public function parse()
    {
        $filePath = 'xml/d_trktrm02318006776042.xml';
        $array = $this->xmlService->parseXml($filePath);
        return response()->json($array);
    }
}
