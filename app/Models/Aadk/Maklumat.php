<?php

namespace App\Models\Aadk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Maklumat extends Model {
    // endpoint 3
    public static function getSejarahLampau(){ 
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kod_penjara.nama_penjara, 
        pesalah_waran.no_waran, 
        pesalah.tarikh_masuk,
        pesalah.epd, 
        pesalah.lpd
        from pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan, kod_penjara, kod_akta
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara
        and pesalah_kesalahan.kod_aktaid = kod_akta.kod_aktaid
        and kod_akta.nama_akta like '%Dadah%";
        return DB::connection()->select($query);
    }

    // endpoint 1
    public static function getHadirProgram(){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kod_penjara.nama_penjara, 
        pesalah_alamat.alamat_tinggal,
        pesalah_waris.nama_waris,
        pesalah_waris.no_tel_waris,
        pesalah_waris.alamat_1_waris,
        pesalah.epd, 
        pesalah.lpd
        from pesalah, pesalah_biodata, pesalah_waris, pesalah_alamat, pesalah_waran, pesalah_kesalahan,kod_penjara
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waris.no_smpp
        and pesalah.no_smpp = pesalah_alamat.no_smpp
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }

    // endpoint 2
    public static function getOrangKenaPengawasan(){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kod_penjara.nama_penjara, 
        pesalah_alamat.alamat_tinggal,
        pesalah_waris.nama_waris,
        pesalah_waris.no_tel_waris,
        pesalah_waris.alamat_1_waris,
        pesalah.epd, 
        pesalah.lpd
        from pesalah, pesalah_biodata, pesalah_waris, pesalah_alamat, pesalah_waran, pesalah_kesalahan,kod_penjara
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waris.no_smpp
        and pesalah.no_smpp = pesalah_alamat.no_smpp
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }
}