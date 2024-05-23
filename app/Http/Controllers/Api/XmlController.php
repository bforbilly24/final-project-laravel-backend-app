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

        // Iterate over each 'c_akun' element and map its content
        foreach ($xml->c_akun as $c_akun) {
            $data[] = [
                'A'  => (string) $c_akun->thang,
                'B'  => (string) $c_akun->kdjendok,
                'C'  => (string) $c_akun->kdsatker,
                'D'  => (string) $c_akun->kddept,
                'E'  => (string) $c_akun->kdunit,
                'F'  => (string) $c_akun->kdprogram,
                'G'  => (string) $c_akun->kdgiat,
                'H'  => (string) $c_akun->kdoutput,
                'I'  => (string) $c_akun->kdlokasi,
                'J'  => (string) $c_akun->kdkabkota,
                'K'  => (string) $c_akun->kddekon,
                'L'  => (string) $c_akun->kdsoutput,
                'M'  => (string) $c_akun->kdkmpnen,
                'N'  => (string) $c_akun->kdskmpnen,
                'O'  => (string) $c_akun->kdakun,
                'P'  => (string) $c_akun->kdkppn,
                'Q'  => (string) $c_akun->kdbeban,
                'R'  => (string) $c_akun->kdjnsban,
                'S'  => (string) $c_akun->kdctarik,
                'T'  => (string) $c_akun->register,
                'U'  => (string) $c_akun->carahitung,
                'V'  => (string) $c_akun->prosenphln,
                'W'  => (string) $c_akun->prosenrkp,
                'X'  => (string) $c_akun->prosenrmp,
                'Y'  => (string) $c_akun->kppnrkp,
                'Z'  => (string) $c_akun->kppnrmp,
                'AA' => (string) $c_akun->kppnphln,
                'BB' => (string) $c_akun->regdam,
                'CC' => (string) $c_akun->kdluncuran,
                'DD' => (string) $c_akun->kdib,
                'FF' => (string) $c_akun->levelrev,
                'GG' => (string) $c_akun->revdipake,
                'HH' => (string) $c_akun->uraiblokir,
                'II' => (string) $c_akun->kdblokir,
            ];
        }

        return $data;
    }
}
