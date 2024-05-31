<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AliasedXmlData;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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

        $xml = simplexml_load_file($request->file('xml_file')->getPathname());
        $data = [];
        $currentTimestamp = Carbon::now('Asia/Jakarta');  // Set timezone to Asia/Jakarta

        foreach ($xml->children() as $akun) {
            $data[] = [
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

        AliasedXmlData::insert($data);

        return response()->json(['success' => 'File uploaded and processed successfully'], 200);
    }

    public function getData(Request $request)
    {
        $data = AliasedXmlData::all();
        return response()->json($data);
    }
}
