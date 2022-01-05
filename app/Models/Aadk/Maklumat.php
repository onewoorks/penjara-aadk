<?php

namespace App\Models\Aadk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Maklumat extends Model {

    public static function getSejarahLampau(){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kod_penjara.nama_penjara, 
        pesalah_waran.no_waran, 
        pesalah.tarikh_masuk,
        pesalah.epd, 
        pesalah.lpd
        from pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan, kod_penjara
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara";
        return DB::connection()->select($query);
    }
}