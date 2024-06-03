<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AliasedXmlData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class XmlController extends Controller
{
    public function uploadXml(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'xml_file' => 'required|file|mimes:xml'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $xml = simplexml_load_file($request->file('xml_file')->getPathname());
            if (!$this->validateXmlStructure($xml)) {
                return response()->json(['error' => 'structure xml is not same'], 400);
            }

            $data = [];
            $currentTimestamp = Carbon::now('Asia/Jakarta');

            foreach ($xml->children() as $akun) {
                $data[] = [
                    // Map XML data to database columns
                    'tahun_anggaran' => (string)$akun->thang,
                    'kode_jenis_dokumen' => (string)$akun->kdjendok,
                    'kode_satker' => (string)$akun->kdsatker,
                    'kode_dept' => (string)$akun->kddept,
                    'kode_unit' => (string)$akun->kdunit,
                    'kode_program' => (string)$akun->kdprogram,
                    'kode_giat' => (string)$akun->kdgiat,
                    'kode_output' => (string)$akun->kdoutput,
                    'kode_lokasi' => (string)$akun->kdlokasi,
                    'kode_kabupaten' => (string)$akun->kdkabkota,
                    'kode_dekon' => (string)$akun->kddekon,
                    'kode_sub_output' => (string)$akun->kdsoutput,
                    'kode_komponen' => (string)$akun->kdkmpnen,
                    'kode_sub_komponen' => (string)$akun->kdskmpnen,
                    'kode_akun' => (string)$akun->kdakun,
                    'kode_kppn' => (string)$akun->kdkppn,
                    'kode_beban' => (string)$akun->kdbeban,
                    'kode_jenis_bantuan' => (string)$akun->kdjnsban,
                    'kode_cara_tarik' => (string)$akun->kdctarik,
                    'register' => (string)$akun->register,
                    'cara_hitung' => (string)$akun->carahitung,
                    'prosentase_phln' => (float)$akun->prosenphln ?: null,
                    'prosentase_rkp' => (float)$akun->prosenrkp ?: null,
                    'prosentase_rmp' => (float)$akun->prosenrmp ?: null,
                    'kppn_rkp' => (string)$akun->kppnrkp ?: null,
                    'kppn_rmp' => (string)$akun->kppnrmp ?: null,
                    'kppn_phln' => (string)$akun->kppnphln ?: null,
                    'reg_dam' => (string)$akun->regdam ?: null,
                    'kode_luncuran' => (string)$akun->kdluncuran ?: null,
                    'kode_blokir' => (string)$akun->kdblokir ?: null,
                    'uraian_blokir' => (string)$akun->uraiblokir ?: null,
                    'kode_ib' => (string)$akun->kdib,
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp
                ];
            }

            // Check if database is full (example check, adjust as needed)
            if (DB::table('aliased_xml_data')->count() >= env('DB_MAX_ROWS', 10000)) {
                return response()->json(['error' => 'storage database is full'], 500);
            }

            // Insert data
            DB::transaction(function () use ($data) {
                AliasedXmlData::insert($data);
            }, 5); // Retry up to 5 times in case of deadlock

            return response()->json(['success' => 'File uploaded and processed successfully'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            if ($e instanceof \Illuminate\Database\QueryException) {
                return response()->json(['error' => 'database error'], 500);
            }
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    public function getData(Request $request)
    {

        $data = AliasedXmlData::all();
        return response()->json($data);
    }

    private function validateXmlStructure($xml)
    {
        $requiredFields = [
            'thang', 'kdjendok', 'kdsatker', 'kddept', 'kdunit', 'kdprogram', 'kdgiat', 'kdoutput',
            'kdlokasi', 'kdkabkota', 'kddekon', 'kdsoutput', 'kdkmpnen', 'kdskmpnen', 'kdakun',
            'kdkppn', 'kdbeban', 'kdjnsban', 'kdctarik', 'register', 'carahitung'
        ];

        foreach ($xml->children() as $child) {
            foreach ($requiredFields as $field) {
                if (!isset($child->$field)) {
                    return false;
                }
            }
        }
        return true;
    }
}
