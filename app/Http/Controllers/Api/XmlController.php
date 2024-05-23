<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;

class XmlController extends Controller
{
    public function upload(Request $request)
    {
        try {
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

            if (isset($data['error'])) {
                return response()->json(['error' => $data['error']], 400);
            }

            // Add timestamps
            $timestamp = Carbon::now();
            foreach ($data as &$entry) {
                $entry['created_at'] = $timestamp;
                $entry['updated_at'] = $timestamp;
            }

            // Insert the data into the database
            DB::table('xml_data')->insert($data);

            return response()->json(['success' => 'File uploaded and processed successfully'], 200);
        } catch (QueryException $e) {
            // Handle database query exceptions
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            // Handle general exceptions
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    private function mapXmlToDatabaseFields($xmlContent)
    {
        try {
            // Load the XML content
            $xml = simplexml_load_string($xmlContent);
            $data = [];
            $requiredFields = [
                'thang', 'kdjendok', 'kdsatker', 'kddept', 'kdunit', 'kdprogram',
                'kdgiat', 'kdoutput', 'kdlokasi', 'kdkabkota', 'kddekon', 'kdsoutput',
                'kdkmpnen', 'kdskmpnen', 'kdakun', 'kdkppn', 'kdbeban', 'kdjnsban',
                'kdctarik', 'register', 'carahitung', 'prosenphln', 'prosenrkp', 'prosenrmp',
                'kppnrkp', 'kppnrmp', 'kppnphln', 'regdam', 'kdluncuran', 'kdib',
                'levelrev', 'revdipake', 'uraiblokir', 'kdblokir'
            ];

            // Loop through all child elements of the root
            foreach ($xml->children() as $element) {
                // Check if the element has all the required fields
                foreach ($requiredFields as $field) {
                    if (!isset($element->$field)) {
                        return ['error' => 'The XML file cannot be uploaded because the format is not suitable'];
                    }
                }

                // If all required fields are present, map them to the database fields
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

            return $data;
        } catch (Exception $e) {
            // Handle XML parsing exceptions
            return ['error' => 'Error parsing XML: ' . $e->getMessage()];
        }
    }

    public function getData()
    {
        try {
            $data = DB::table('xml_data')->get();

            if ($data->isEmpty()) {
                return response()->json(['error' => 'No data found'], 404);
            }

            return response()->json(['data' => $data], 200);
        } catch (QueryException $e) {
            // Handle database query exceptions
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            // Handle general exceptions
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }
}
