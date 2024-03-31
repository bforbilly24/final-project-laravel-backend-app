<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rkks;
use App\Services\XmlService;
use Illuminate\Http\Request;

class RkksController extends Controller
{
    public function index()
    {
        $rkks = Rkks::all();

        // $rkks = Rkks::latest()->paginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $rkks,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, XmlService $xmlService)
    {
        $request->validate([
            'rkks_xml' =>  'required|file|mimes:xml',
        ]);

        $rkksXml = $request->file('rkks_xml');

        // Parse the XML file
        // $array = $xmlService->parseXml($rkksXml->getRealPath());

        // Store the name of the XML file
        Rkks::create([
            'xmlFileName' => $rkksXml->getClientOriginalName(),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => 'Rkks created successfully',
        ]);
    }

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
