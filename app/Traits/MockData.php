<?php 

namespace App\Traits;

trait MockData {

    public function mockPesalahByIc(){
        $data = [[
            'mykad' => '890123045668',
            'nama' => 'ANI',
            'alamat01' => '',
            'alamat02' => '',
            'alamat03' => '',
            'poskod' => '',
            'kesnegeri' => '',
            'tarikhperintahmahkamah' => '',
            'mahkamah' => '',
            'seksyenkesalahan' => '107',
            'puspen' => '',
            'pengawasanaadkdaerah' => '',
            'pengawasanaadknegeri' => '',
            'tarikhmulapengawasan' => '',
            'tarikhtamatpengawasan' => '',
            'lokasipenjara' => 'Penjara Wanita Kajang',
            'nowaran' => 'WR2019-32',
            'akta' => 'Kanun Keseksaan',
        ]];
        return $data;
    }


    public function mockHadirProgram(){
        $data = '[
            {
                "nama_pesalah" : "MOHD ADHA",
                "no_ic_baru" : "910101075009",
                "nama_penjara" : "Pusat Pemulihan Akhlak (PPA) Batu Gajah",
                "alamat_tinggal" : "shah alam",
                "nama_waris" : "junni A\/L Mumni",
                "no_tel_waris" : "",
                "alamat_1_waris" : "shah alam",
                "epd" : "",
                "lpd" : "2022-01-15"
            },
            {
                "nama_pesalah" : "MOHD ADHA",
                "no_ic_baru" : "910101075009",
                "nama_penjara" : "Pusat Pemulihan Akhlak (PPA) Batu Gajah",
                "alamat_tinggal" : "shah alam",
                "nama_waris" : "junni A\/L Mumni",
                "no_tel_waris" : "",
                "alamat_1_waris" : "shah alam",
                "epd" : "",
                "lpd" : "2022-01-15"
            }
        ]';
        return json_decode($data);
    }

}