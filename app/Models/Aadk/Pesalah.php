<?php

namespace App\Models\Aadk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesalah extends Model {

    public static function getPesalah($no_kp){
        $query = "SELECT 
        pesalah.nama_pesalah, pesalah_biodata.no_ic_baru, 
        pesalah_waran.no_waran, pesalah_kesalahan.akta, pesalah_kesalahan.seksyen, 
        -- pesalah.lokasi_penjara, 
        pesalah.epd, pesalah.lpd,
        (select nama_penjara from kod_penjara where kod_penjara = pesalah.lokasi_penjara ) as lokasi_penjara
        FROM pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan
        WHERE pesalah.no_smpp = pesalah_biodata.no_smpp
        AND pesalah_biodata.no_ic_baru IN ($no_kp)
        AND pesalah.no_smpp = pesalah_waran.no_smpp
        AND pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }

    public static function getAllPesalah(){
        $query = "SELECT 
        pesalah.nama_pesalah, pesalah_biodata.no_ic_baru, 
        pesalah_waran.no_waran, pesalah_kesalahan.akta, pesalah_kesalahan.seksyen, 
        -- pesalah.lokasi_penjara, 
        pesalah.epd, pesalah.lpd,
        (select nama_penjara from kod_penjara where kod_penjara = pesalah.lokasi_penjara ) as lokasi_penjara
        FROM pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan
        WHERE pesalah.no_smpp = pesalah_biodata.no_smpp
        AND pesalah.no_smpp = pesalah_waran.no_smpp
        AND pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }

    public function getPesalahWithFormat($no_kp){
        $query = "SELECT 
        pesalah_biodata.no_ic_baru as myKad,
        pesalah.nama_pesalah as nama, 
        '' as alamat01,
        '' as alamat02,
        '' as alamat03,
        '' as poskod,
        '' as kesNegeri,
        '' as tarikhPerintahMahkamah,
        '' as mahkamah,
        pesalah_kesalahan.seksyen as seksyenKesalahan,
        '' as puspen,
        '' as pengawasanAADKDaerah,
        '' as pengawasanAADKNegeri,
        pesalah.epd as tarikhMulaPengawasan,
        pesalah.lpd as tarikhTamatPengawasan,
        (select nama_penjara from kod_penjara where kod_penjara = pesalah.lokasi_penjara ) as lokasiPenjara,
        pesalah_waran.no_waran as noWaran, 
        pesalah_kesalahan.akta as akta  
        FROM pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan
        WHERE pesalah.no_smpp = pesalah_biodata.no_smpp
        AND pesalah_biodata.no_ic_baru IN ($no_kp)
        AND pesalah.no_smpp = pesalah_waran.no_smpp
        AND pesalah_waran.id = pesalah_kesalahan.waran_id";
        return DB::connection()->select($query);
    }

}