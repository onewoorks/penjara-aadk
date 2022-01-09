<?php

namespace App\Models\Aadk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Maklumat extends Model {

    // endpoint 1
    public static function getHadirProgram($no_kp = false){
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
        $query .= ($no_kp) ? " and pesalah_biodata.no_ic_baru = $no_kp" : '';
        return DB::connection()->select($query);
    }

    // endpoint 2
    public static function getOrangKenaPengawasan($no_kp = false){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kod_penjara.nama_penjara, 
        pesalah_alamat.alamat_tinggal,
        pesalah_waris.nama_waris,
        pesalah_waris.no_tel_waris,
        pesalah_waris.alamat_1_waris,
        pesalah.epd, 
        pesalah.lpd
        from pesalah, pesalah_biodata, pesalah_waris, pesalah_alamat, pesalah_waran, pesalah_kesalahan,kod_penjara, kod_seksyen
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waris.no_smpp
        and pesalah.no_smpp = pesalah_alamat.no_smpp
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id
        and pesalah_kesalahan.kod_aktaid = kod_seksyen.kod_aktaid
        and kod_seksyen.kod_aktaid = 81";
        $query .= ($no_kp) ? " and pesalah_biodata.no_ic_baru = $no_kp" : '';
        return DB::connection()->select($query);
    }

    // endpoint 3
    public static function getSejarahLampau($no_kp = false){ 
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
        and kod_akta.kod_aktaid = 7
        or kod_akta.kod_aktaid = 44
        or kod_akta.kod_aktaid = 62
        or kod_akta.kod_aktaid = 85
        or kod_akta.kod_aktaid = 88
        or kod_akta.kod_aktaid = 104
        or kod_akta.kod_aktaid = 120
        or kod_akta.kod_aktaid = 139
        or kod_akta.kod_aktaid = 177
        or kod_akta.kod_aktaid = 191
        or kod_akta.kod_aktaid = 200
        or kod_akta.kod_aktaid = 212
        or kod_akta.kod_aktaid = 213
        or kod_akta.kod_aktaid = 216
        or kod_akta.kod_aktaid = 219
        or kod_akta.kod_aktaid = 305
        or kod_akta.kod_aktaid = 328
        or kod_akta.kod_aktaid = 397
        or kod_akta.kod_aktaid = 450";
        $query .= ($no_kp) ? " and pesalah_biodata.no_ic_baru = $no_kp" : '';
        $query .= " LIMIT 100";
        return DB::connection()->select($query);
        
    }

    //endpoint 4
    public static function getPrestasi($no_kp = false){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru, 
        kerjaya.jenis_program,
        kerjaya.tarikh_mula_kursus,
        kerjaya.tarikh_tamat_kursus,
        ppi.fasa_semasa,
        ppi.program,
        ppi.tarikh_mula,
        ppi.tarikh_tamat
        from pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan, kod_akta, kerjaya, ppi
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and kerjaya.no_smpp = pesalah.no_smpp
        and ppi.no_smpp = pesalah.no_smpp
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id
        and pesalah_kesalahan.kod_aktaid = kod_akta.kod_aktaid
        and kod_akta.kod_aktaid = 7
        or kod_akta.kod_aktaid = 44
        or kod_akta.kod_aktaid = 62
        or kod_akta.kod_aktaid = 85
        or kod_akta.kod_aktaid = 88
        or kod_akta.kod_aktaid = 104
        or kod_akta.kod_aktaid = 120
        or kod_akta.kod_aktaid = 139
        or kod_akta.kod_aktaid = 177
        or kod_akta.kod_aktaid = 191
        or kod_akta.kod_aktaid = 200
        or kod_akta.kod_aktaid = 212
        or kod_akta.kod_aktaid = 213
        or kod_akta.kod_aktaid = 216
        or kod_akta.kod_aktaid = 219
        or kod_akta.kod_aktaid = 305
        or kod_akta.kod_aktaid = 328
        or kod_akta.kod_aktaid = 397
        or kod_akta.kod_aktaid = 450";
        $query .= ($no_kp) ? " and pesalah_biodata.no_ic_baru = $no_kp" : '';
        $query .= " LIMIT 100";
        return DB::connection()->select($query);
    }

    // endpoint 5
    public static function getDadah($no_kp = false){
        $query = "select pesalah.nama_pesalah, 
        pesalah_biodata.no_ic_baru,
        kod_penjara.nama_penjara, 
        pesalah_alamat.alamat_tinggal,
        pesalah_waris.nama_waris,
        pesalah_waris.no_tel_waris,
        pesalah_waris.alamat_1_waris,
        pesalah.epd, 
        pesalah.lpd,
        pesalah_waran.no_waran, 
        pesalah_kesalahan.seksyen 
        from pesalah, pesalah_biodata, pesalah_waran, pesalah_kesalahan, pesalah_alamat, kod_penjara, kod_akta, pesalah_waris, kod_seksyen
        where pesalah.no_smpp = pesalah_biodata.no_smpp
        and pesalah.no_smpp = pesalah_waris.no_smpp
        and pesalah.no_smpp = pesalah_alamat.no_smpp
        and pesalah.no_smpp = pesalah_waran.no_smpp
        and pesalah_waran.id = pesalah_kesalahan.waran_id
        and pesalah.lokasi_penjara = kod_penjara.kod_penjara
        and pesalah_kesalahan.kod_aktaid = kod_seksyen.kod_aktaid
        and kod_seksyen.kod_aktaid = 419
        or kod_seksyen.kod_aktaid = 420
        or kod_seksyen.kod_aktaid = 425
        or kod_seksyen.kod_aktaid = 426
        or kod_seksyen.kod_aktaid = 1510
        or kod_seksyen.kod_aktaid = 427
        or kod_seksyen.kod_aktaid = 1700
        or kod_seksyen.kod_aktaid = 1706
        or kod_seksyen.kod_aktaid = 1707
        or kod_seksyen.kod_aktaid = 1714
        or kod_seksyen.kod_aktaid = 2370";
        $query .= ($no_kp) ? " and pesalah_biodata.no_ic_baru = $no_kp" : '';
        $query .= " LIMIT 100";
        return DB::connection()->select($query);
    }
}