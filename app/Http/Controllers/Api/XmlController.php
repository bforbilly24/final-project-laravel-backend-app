<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class XmlController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'xml_file' => 'required|file|mimes:xml',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Retrieve the file from the request
        $file = $request->file('xml_file');
        $xmlContent = file_get_contents($file);

        // Parse and map the XML content to database fields
        $data = $this->mapXmlToDatabaseFields($xmlContent);

        // Insert the data into the database
        DB::table('xml_data')->insert($data);

        return response()->json(['success' => 'File uploaded and processed successfully'], 200);
    }

    private function mapXmlToDatabaseFields($xmlContent)
    {
        // Load the XML content
        $xml = simplexml_load_string($xmlContent);
        $data = [];

        // Loop through all child elements of the root
        foreach ($xml->children() as $element) {
            // Check if the element has the expected child structure
            if (isset($element->thang)) {
                $data[] = [
                    'A'  => (string) $element->thang,
                    'B'  => (string) $element->kdjendok,
                    'C'  => (string) $element->kdsatker,
                    'D'  => (string) $element->kddept,
                    'E'  => (string) $element->kdunit,
                    'F'  => (string) $element->kdprogram,
                    'G'  => (string) $element->kdgiat,
                    'H'  => (string) $element->kdoutput,
                    'I'  => (string) $element->kdlokasi,
                    'J'  => (string) $element->kdkabkota,
                    'K'  => (string) $element->kddekon,
                    'L'  => (string) $element->kdsoutput,
                    'M'  => (string) $element->kdkmpnen,
                    'N'  => (string) $element->kdskmpnen,
                    'O'  => (string) $element->kdakun,
                    'P'  => (string) $element->kdkppn,
                    'Q'  => (string) $element->kdbeban,
                    'R'  => (string) $element->kdjnsban,
                    'S'  => (string) $element->kdctarik,
                    'T'  => (string) $element->register,
                    'U'  => (string) $element->carahitung,
                    'V'  => (string) $element->prosenphln,
                    'W'  => (string) $element->prosenrkp,
                    'X'  => (string) $element->prosenrmp,
                    'Y'  => (string) $element->kppnrkp,
                    'Z'  => (string) $element->kppnrmp,
                    'AA' => (string) $element->kppnphln,
                    'BB' => (string) $element->regdam,
                    'CC' => (string) $element->kdluncuran,
                    'DD' => (string) $element->kdib,
                    'FF' => (string) $element->levelrev,
                    'GG' => (string) $element->revdipake,
                    'HH' => (string) $element->uraiblokir,
                    'II' => (string) $element->kdblokir,
                ];
            }
        }

        return $data;
    }
}
