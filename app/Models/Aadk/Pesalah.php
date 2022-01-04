<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesalah extends Model {

    public static function getPesalah(){
        $query = "SELECT 
        pesalah.nama_pesalah, pesalah_biodata.no_ic_baru, 
        pesalah_waran.no_waran, pesalah_kesalahan.akta, pesalah_kesalahan.seksyen, pesalah.lokasi_penjara, pesalah.epd, pesalah.lpd
        FROM pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan
        WHERE pesalah.no_smpp = pesalah_biodata.no_smpp
        AND pesalah_biodata.no_ic_baru = '920102030405'
        AND pesalah.no_smpp = pesalah_waran.no_smpp
        AND pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }

}