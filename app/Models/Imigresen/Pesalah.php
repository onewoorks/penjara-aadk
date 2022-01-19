<?php

namespace App\Models\Imigresen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesalah extends Model {

    public static function getPesalahPassport($passport_no){
        $query = "select 
            f.nama_pesalah,
            g.nama_penjara, 
            date_part('year',age(current_date,k.tarikh_lahir)) as umur,
            k.jantina,k.agama,
            k.bangsa,
            k.no_smpp,
            k.no_passport,
            k.warganegara,
            f.epd as tarikh_bebas,
            f.tarikh_mula_huk, f.epd as tarikh_bebas_awal,
            f.lpd as tarikh_bebas_lewat,
            a.nama_waris,
            a.no_tel_waris,
            a.alamat_1_waris,
            c.jenis_harta,
            c.keterangan as keterangan_harta, 
            c.kategori_harta, 
            d.waran_id, 
            d.no_waran, 
            e.keterangan_hukuman, 
            e.akta,e.seksyen,
            n.hiv_screening as Saringan_kemasukan_hiv,
            n.tb as Saringan_kemasukan_tb,
            m.hiv_test as Saringan_semasa_hiv,
            m.known_case as Penyakit_sedang_dirawat, 
            m.current_medication as Ubatan_semasa
            from 
            pesalah_waris a, pesalah_harta_benda c, pesalah f,pesalah_biodata k, pesalah_waran d, pesalah_kesalahan e, kod_penjara g, rawatan_saringan m,rawatan_kemasukan n
            where k.no_passport= '$passport_no' 
            and k.no_smpp=a.no_smpp  
            and k.no_smpp=c.no_smpp  
            and k.no_smpp=f.no_smpp  
            and k.no_smpp=d.no_smpp and k.no_smpp=m.no_smpp and k.no_smpp=n.no_smpp and d.waran_id in(select waran_id from pesalah_waran where  d.no_smpp=k.no_smpp) and d.waran_id=e.waran_id and f.lokasi_penjara=g.kod_penjara
        ";
        return DB::connection()->select($query);
    }

    public static function getPesalahSmppNo($smpp_no){
        $query = "select f.nama_pesalah,g.nama_penjara, date_part('year',age(current_date,b.tarikh_lahir))as umur,b.jantina,b.agama,b.bangsa,f.no_smpp,b.no_passport,b.warganegara,f.epd as tarikh_bebas_awal,f.lpd as tarikh_bebas_lewat,f.tarikh_mula_huk as Tarikh_mula_hukuman,a.nama_waris,a.no_tel_waris,a.alamat_1_waris,c.jenis_harta,c.keterangan as keterangan_harta, c.kategori_harta, d.waran_id, d.no_waran,e.akta,e.seksyen,e.keterangan_hukuman,
        n.hiv_screening as Saringan_kemasukan_hiv,n.tb as Saringan_kemasukan_tb,m.hiv_test as Saringan_semasa_hiv,m.known_case as Penyakit_sedang_dirawat, m.current_medication as Ubatan_semasa
        from pesalah_waris a, pesalah_harta_benda c, pesalah f,pesalah_biodata b, pesalah_waran d, pesalah_kesalahan e, kod_penjara g, rawatan_saringan m,rawatan_kemasukan n
        where f.no_smpp='$smpp_no' and  f.no_smpp=c.no_smpp and f.no_smpp=a.no_smpp and f.no_smpp=b.no_smpp and d.waran_id=e.waran_id and f.no_smpp=m.no_smpp and f.no_smpp=n.no_smpp and d.waran_id in(select waran_id from pesalah_waran where d.no_smpp=f.no_smpp) and d.waran_id=e.waran_id and f.lokasi_penjara=g.kod_penjara
        ";
        return DB::connection()->select($query);
    }

}