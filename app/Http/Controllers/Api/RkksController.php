<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rkks;
use App\Services\XmlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $path = $rkksXml->store('xml-data');

        // Store the name of the XML file
        Rkks::create([
            'xmlFileName' => $path,
        ]);

        // Check if the number of records is more than 10
        if (Rkks::count() > 10) {
            // Get the oldest record
            $oldestRecord = Rkks::oldest()->first();

            // Delete the XML file
            Storage::delete($oldestRecord->xmlFileName);

            // Delete the record from the database
            $oldestRecord->delete();
        }

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
        // Get the latest XML file name from the database
        $latestXmlFile = Rkks::latest()->first();

        // If there's no record in the database, return an error message
        if (!$latestXmlFile) {
            return response()->json(['error' => 'No XML file found'], 404);
        }

        // Construct the file path
        $filePath = $latestXmlFile->xmlFileName;

        // Parse the XML file to JSON
        $array = $this->xmlService->parseXml($filePath);

        return response()->json($array);
    }
}
