<?php 

namespace App\Http\Controllers\Aadk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Aadk\Pesalah;
use App\Traits\RequestResponse;
use App\Traits\HmpkErrors;
use App\Traits\MockData;

class PesalahController extends Controller{

    use RequestResponse;
    use HmpkErrors;
    use MockData;

    public function getAllPesalah(){
        $data = array(
            'pesalah' => Pesalah::getAllPesalah(),
        );
        return response()->json($data);
    }

    public function getNoByIc(Request $request){
        $data           = json_decode($request->getContent());
        $request        = $this->validateRequest($data);
        $data->hpmk_message->hpmk_message_payload = (Object) array();
        if($request->status == 'success'){
            $valid_ic       = $this->validateIdentification($request->message->kp);
            if(!$valid_ic){
                $nric       = $this->cleaningIcPayload($request->message->kp);
                // $pesalah    = Pesalah::getPesalahWithFormat($nric);
                $pesalah = $this->mockPesalahByIc();
                $data->hpmk_message->hpmkmessage_payload = (Object) array();
                $data->hpmk_message->hpmk_message_payload->hpmk_data  = $this->finalResult($pesalah);
            } else {
                $data->hpmk_message->hpmk_message_payload->hpmk_error = $valid_ic;
            }
        } else {
            $data->hpmk_message->hpmk_message_payload->hpmk_error = $request->message->hmpk_error;
        }
        return response()->json($data);
    }

    private function icWithResult($payload){
        $clean = array();
        foreach($payload as $pesalah){
            $clean[$pesalah->no_ic_baru][] = $pesalah;
        }
        return (object) $clean;
    }

    private function responsePesalah($payload){
        return array(
            "myKad"                     => "no_ic_baru",
            "nama"                      => "nama_pesalah",
            "alamat01"                  => "KAMPUNG TUNKU ISMAIL",
            "alamat02"                  => "KELANG LAMA",
            "alamat03"                  => "",
            "poskod"                    => "09000",
            "negeri"                    => "02",
            "tarikhPerintahMahkamah"    => "2020-02-21",
            "mahkamah"                  => "MAHKAMAH MAJISTRET KULIM",
            "seksyenKesalahan"          => "38B",
            "puspen"                    => null,
            "pengawasanAADKDaerah"      => "AADK DAERAH KULIM",
            "pengawasanAADKNegeri"      => "Kedah",
            "tarikhMulaPengawasan"      => "2020-02-21",
            "tarikhTamatPengawasan"     => "2022-02-21",
        );
    }

}