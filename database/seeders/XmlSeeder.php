<?php

// database/seeders/XmlSeeder.php

namespace Database\Seeders;

use App\Models\Xml;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class XmlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = Storage::allFiles('data-belly');

        foreach ($files as $filePath) {
            if (pathinfo($filePath, PATHINFO_EXTENSION) === 'xml') {
                $xmlContent = Storage::get($filePath);
                $data = $this->mapXmlToDatabaseFields($xmlContent);

                foreach ($data as $entry) {
                    Xml::create($entry);
                }
            }
        }
    }

    private function mapXmlToDatabaseFields($xmlContent)
    {
        $xml = simplexml_load_string($xmlContent);
        $data = [];

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
