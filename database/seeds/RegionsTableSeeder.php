<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('regions')->delete();
        
        \DB::table('regions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'denj' => 'ALBA',
                'fsj' => 1,
                'mnemonic' => 'AB',
                'zona' => 7,
            ),
            1 => 
            array (
                'id' => 2,
                'denj' => 'ARAD',
                'fsj' => 2,
                'mnemonic' => 'AR',
                'zona' => 5,
            ),
            2 => 
            array (
                'id' => 3,
                'denj' => 'ARGES',
                'fsj' => 3,
                'mnemonic' => 'AG',
                'zona' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'denj' => 'BACAU',
                'fsj' => 4,
                'mnemonic' => 'BC',
                'zona' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'denj' => 'BIHOR',
                'fsj' => 5,
                'mnemonic' => 'BH',
                'zona' => 6,
            ),
            5 => 
            array (
                'id' => 6,
                'denj' => 'BISTRITA-NASAUD',
                'fsj' => 6,
                'mnemonic' => 'BN',
                'zona' => 6,
            ),
            6 => 
            array (
                'id' => 7,
                'denj' => 'BOTOSANI',
                'fsj' => 7,
                'mnemonic' => 'BT',
                'zona' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'denj' => 'BRASOV',
                'fsj' => 8,
                'mnemonic' => 'BV',
                'zona' => 7,
            ),
            8 => 
            array (
                'id' => 9,
                'denj' => 'BRAILA',
                'fsj' => 9,
                'mnemonic' => 'BR',
                'zona' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'denj' => 'BUZAU',
                'fsj' => 10,
                'mnemonic' => 'BZ',
                'zona' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'denj' => 'CARAS-SEVERIN',
                'fsj' => 11,
                'mnemonic' => 'CS',
                'zona' => 5,
            ),
            11 => 
            array (
                'id' => 12,
                'denj' => 'CLUJ',
                'fsj' => 13,
                'mnemonic' => 'CJ',
                'zona' => 6,
            ),
            12 => 
            array (
                'id' => 13,
                'denj' => 'CONSTANTA',
                'fsj' => 14,
                'mnemonic' => 'CT',
                'zona' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'denj' => 'COVASNA',
                'fsj' => 15,
                'mnemonic' => 'CV',
                'zona' => 7,
            ),
            14 => 
            array (
                'id' => 15,
                'denj' => 'DIMBOVITA',
                'fsj' => 16,
                'mnemonic' => 'DB',
                'zona' => 3,
            ),
            15 => 
            array (
                'id' => 16,
                'denj' => 'DOLJ',
                'fsj' => 17,
                'mnemonic' => 'DJ',
                'zona' => 4,
            ),
            16 => 
            array (
                'id' => 17,
                'denj' => 'GALATI',
                'fsj' => 18,
                'mnemonic' => 'GL',
                'zona' => 2,
            ),
            17 => 
            array (
                'id' => 18,
                'denj' => 'GORJ',
                'fsj' => 20,
                'mnemonic' => 'GJ',
                'zona' => 4,
            ),
            18 => 
            array (
                'id' => 19,
                'denj' => 'HARGHITA',
                'fsj' => 21,
                'mnemonic' => 'HR',
                'zona' => 7,
            ),
            19 => 
            array (
                'id' => 20,
                'denj' => 'HUNEDOARA',
                'fsj' => 22,
                'mnemonic' => 'HD',
                'zona' => 5,
            ),
            20 => 
            array (
                'id' => 21,
                'denj' => 'IALOMITA',
                'fsj' => 23,
                'mnemonic' => 'IL',
                'zona' => 3,
            ),
            21 => 
            array (
                'id' => 22,
                'denj' => 'IASI',
                'fsj' => 24,
                'mnemonic' => 'IS',
                'zona' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'denj' => 'ILFOV',
                'fsj' => 25,
                'mnemonic' => 'IF',
                'zona' => 8,
            ),
            23 => 
            array (
                'id' => 24,
                'denj' => 'MARAMURES',
                'fsj' => 26,
                'mnemonic' => 'MM',
                'zona' => 6,
            ),
            24 => 
            array (
                'id' => 25,
                'denj' => 'MEHEDINTI',
                'fsj' => 27,
                'mnemonic' => 'MH',
                'zona' => 4,
            ),
            25 => 
            array (
                'id' => 26,
                'denj' => 'MURES',
                'fsj' => 28,
                'mnemonic' => 'MS',
                'zona' => 7,
            ),
            26 => 
            array (
                'id' => 27,
                'denj' => 'NEAMT',
                'fsj' => 29,
                'mnemonic' => 'NT',
                'zona' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'denj' => 'OLT',
                'fsj' => 30,
                'mnemonic' => 'OT',
                'zona' => 4,
            ),
            28 => 
            array (
                'id' => 29,
                'denj' => 'PRAHOVA',
                'fsj' => 31,
                'mnemonic' => 'PH',
                'zona' => 3,
            ),
            29 => 
            array (
                'id' => 30,
                'denj' => 'SATU_MARE',
                'fsj' => 32,
                'mnemonic' => 'SM',
                'zona' => 6,
            ),
            30 => 
            array (
                'id' => 31,
                'denj' => 'SALAJ',
                'fsj' => 33,
                'mnemonic' => 'SJ',
                'zona' => 6,
            ),
            31 => 
            array (
                'id' => 32,
                'denj' => 'SIBIU',
                'fsj' => 34,
                'mnemonic' => 'SB',
                'zona' => 7,
            ),
            32 => 
            array (
                'id' => 33,
                'denj' => 'SUCEAVA',
                'fsj' => 35,
                'mnemonic' => 'SV',
                'zona' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'denj' => 'TELEORMAN',
                'fsj' => 36,
                'mnemonic' => 'TR',
                'zona' => 3,
            ),
            34 => 
            array (
                'id' => 35,
                'denj' => 'TIMIS',
                'fsj' => 37,
                'mnemonic' => 'TM',
                'zona' => 5,
            ),
            35 => 
            array (
                'id' => 36,
                'denj' => 'TULCEA',
                'fsj' => 38,
                'mnemonic' => 'TL',
                'zona' => 2,
            ),
            36 => 
            array (
                'id' => 37,
                'denj' => 'VASLUI',
                'fsj' => 39,
                'mnemonic' => 'VS',
                'zona' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'denj' => 'VILCEA',
                'fsj' => 40,
                'mnemonic' => 'VL',
                'zona' => 4,
            ),
            38 => 
            array (
                'id' => 39,
                'denj' => 'VRANCEA',
                'fsj' => 41,
                'mnemonic' => 'VN',
                'zona' => 2,
            ),
            39 => 
            array (
                'id' => 40,
                'denj' => 'BUCURESTI',
                'fsj' => 42,
                'mnemonic' => 'B',
                'zona' => 8,
            ),
            40 => 
            array (
                'id' => 51,
                'denj' => 'CALARASI',
                'fsj' => 12,
                'mnemonic' => 'CL',
                'zona' => 3,
            ),
            41 => 
            array (
                'id' => 52,
                'denj' => 'GIURGIU',
                'fsj' => 19,
                'mnemonic' => 'GR',
                'zona' => 3,
            ),
        ));
        
        
    }
}