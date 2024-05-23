<?php

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
