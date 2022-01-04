<?php 

namespace App\Http\Controllers\Aadk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Aadk\Pesalah;

class PesalahController extends Controller{

    public function getAllPesalah(){
        $data = array(
            'pesalah' => Pesalah::getAllPesalah(),
        );
        return response()->json($data);
    }

    public function getNoByIc(Request $request){
        $data       = json_decode($request->getContent());
        $ic_list    = $this->cleaningIcPayload($data);
        $pesalah    = Pesalah::getPesalah($ic_list);
        $data       = array(
            'pesalah' => $pesalah,
        );
        return response()->json($data);
    }

    private function cleaningIcPayload($payload){
        $ic_list = array();
        if (gettype($payload->no_kp) != 'array'){
            $data->no_kp = array($data->no_kp);
        }
        foreach($payload->no_kp as $no_kp){
            $ic_list[]  = strval($no_kp);
        }
        return $ic_list;
    }
}