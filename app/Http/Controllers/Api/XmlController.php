<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AliasedXmlData;
use Illuminate\Support\Facades\DB;

class XmlController extends Controller
{
    public function uploadXml(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml'
        ]);

        $file = $request->file('xml_file');
        $xmlContent = file_get_contents($file->getRealPath());
        $xml = simplexml_load_string($xmlContent);

        if (!$this->validateXmlStructure($xml)) {
            return response()->json(['message' => 'Invalid XML structure.'], 400);
        }

        foreach ($xml->c_item as $item) {
            AliasedXmlData::create([
                'tahun_anggaran' => (string) $item->thang ?: '',
                'kode_jenis_dokumen' => (string) $item->kdjendok ?: '',
                'kode_satker' => (string) $item->kdsatker ?: '',
                'kode_departemen' => (string) $item->kddept ?: '',
                'kode_unit' => (string) $item->kdunit ?: '',
                'kode_program' => (string) $item->kdprogram ?: '',
                'kode_kegiatan' => (string) $item->kdgiat ?: '',
                'kode_output' => (string) $item->kdoutput ?: '',
                'kode_lokasi' => (string) $item->kdlokasi ?: '',
                'kode_kabupaten_kota' => (string) $item->kdkabkota ?: '',
                'kode_dekon' => (string) $item->kddekon ?: '',
                'kode_soutput' => (string) $item->kdsoutput ?: '',
                'kode_komponen' => (string) $item->kdkmpnen ?: '',
                'kode_skomponen' => (string) $item->kdskmpnen ?: '',
                'kode_akun' => (string) $item->kdakun ?: '',
                'kode_kppn' => (string) $item->kdkppn ?: '',
                'kode_beban' => (string) $item->kdbeban ?: '',
                'kode_jenis_bantuan' => (string) $item->kdjnsban ?: '',
                'kode_cara_tarik' => (string) $item->kdctarik ?: '',
                'register' => (string) $item->register ?: '',
                'cara_hitung' => (string) $item->carahitung ?: '',
                'header1' => (string) $item->header1 ?: '',
                'header2' => (string) $item->header2 ?: '',
                'kode_header' => (string) $item->kdheader ?: '',
                'nomor_item' => (int) $item->noitem ?: 0,
                'nama_item' => (string) $item->nmitem ?: '',
                'volume1' => (int) $item->vol1 ?: 0,
                'satuan1' => (string) $item->sat1 ?: '',
                'volume2' => (int) $item->vol2 ?: 0,
                'satuan2' => (string) $item->sat2 ?: '',
                'volume3' => (int) $item->vol3 ?: 0,
                'satuan3' => (string) $item->sat3 ?: '',
                'volume4' => (int) $item->vol4 ?: 0,
                'satuan4' => (string) $item->sat4 ?: '',
                'volume_kegiatan' => (float) $item->volkeg ?: 0,
                'satuan_kegiatan' => (string) $item->satkeg ?: '',
                'harga_satuan' => (float) $item->hargasat ?: 0,
                'jumlah' => (float) $item->jumlah ?: 0,
                'jumlah2' => (float) $item->jumlah2 ?: 0,
                'pagu_phln' => (float) $item->paguphln ?: 0,
                'pagu_rmp' => (float) $item->pagurmp ?: 0,
                'pagu_rkp' => (float) $item->pagurkp ?: 0,
                'kode_blokir' => (string) $item->kdblokir ?: '',
                'blokir_phln' => (float) $item->blokirphln ?: 0,
                'blokir_rmp' => (float) $item->blokirrmp ?: 0,
                'blokir_rkp' => (float) $item->blokirrkp ?: 0,
                'rupiah_blokir' => (float) $item->rphblokir ?: 0,
                'kode_copy' => (string) $item->kdcopy ?: '',
                'kode_abt' => (string) $item->kdabt ?: '',
                'kode_sbu' => (string) $item->kdsbu ?: '',
                'volume_sbk' => (float) $item->volsbk ?: 0,
                'volume_rkakl' => (float) $item->volrkakl ?: 0,
                'bulan_kontrak' => (string) $item->blnkontrak ?: '',
                'nomor_kontrak' => (string) $item->nokontrak ?: '',
                'tanggal_kontrak' => $this->parseDate((string) $item->tgkontrak),
                'nilai_kontrak' => (float) $item->nilkontrak ?: 0,
                'januari' => (float) $item->januari ?: 0,
                'februari' => (float) $item->pebruari ?: 0,
                'maret' => (float) $item->maret ?: 0,
                'april' => (float) $item->april ?: 0,
                'mei' => (float) $item->mei ?: 0,
                'juni' => (float) $item->juni ?: 0,
                'juli' => (float) $item->juli ?: 0,
                'agustus' => (float) $item->agustus ?: 0,
                'september' => (float) $item->september ?: 0,
                'oktober' => (float) $item->oktober ?: 0,
                'november' => (float) $item->nopember ?: 0,
                'desember' => (float) $item->desember ?: 0,
                'jumlah_tunda' => (float) $item->jmltunda ?: 0,
                'kode_luncuran' => (string) $item->kdluncuran ?: '',
                'jumlah_abt' => (float) $item->jmlabt ?: 0,
                'nomor_revisi' => (string) $item->norev ?: '',
                'kode_ubah' => (string) $item->kdubah ?: '',
                'kurs' => (float) $item->kurs ?: 1,
                'index_kpjm' => (float) $item->indexkpjm ?: 0,
                'kode_ib' => (string) $item->kdib ?: '',
                'kode_status' => (string) $item->kdstatus ?: '',
                'level_revisi' => (string) $item->levelrev ?: '',
                'revisi_rkakl_ke' => (string) $item->revrkaklke ?: '',
                'revisi_dipa_ke' => (string) $item->revdipake ?: ''
            ]);
        }

        return response()->json(['message' => 'File XML uploaded successfully.'], 200);
    }

    private function validateXmlStructure($xml)
    {
        $requiredFields = [
            'thang', 'kdjendok', 'kdsatker', 'kddept', 'kdunit', 'kdprogram',
            'kdgiat', 'kdoutput', 'kdlokasi', 'kdkabkota', 'kddekon', 'kdsoutput',
            'kdkmpnen', 'kdskmpnen', 'kdakun', 'kdkppn', 'kdbeban', 'kdjnsban',
            'kdctarik', 'register', 'carahitung', 'header1', 'header2', 'kdheader',
            'noitem', 'nmitem', 'vol1', 'sat1', 'vol2', 'sat2', 'vol3', 'sat3',
            'vol4', 'sat4', 'volkeg', 'satkeg', 'hargasat', 'jumlah', 'jumlah2',
            'paguphln', 'pagurmp', 'pagurkp', 'kdblokir', 'blokirphln', 'blokirrmp',
            'blokirrkp', 'rphblokir', 'kdcopy', 'kdabt', 'kdsbu', 'volsbk', 'volrkakl',
            'blnkontrak', 'nokontrak', 'tgkontrak', 'nilkontrak', 'januari', 'pebruari',
            'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober',
            'nopember', 'desember', 'jmltunda', 'kdluncuran', 'jmlabt', 'norev',
            'kdubah', 'kurs', 'indexkpjm', 'kdib', 'kdstatus', 'levelrev', 'revrkaklke',
            'revdipake'
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

    private function parseDate($dateString)
    {
        return $dateString ? date('Y-m-d', strtotime($dateString)) : null;
    }

    public function getData()
    {

        $data = AliasedXmlData::all();
        return response()->json($data);
    }
}
