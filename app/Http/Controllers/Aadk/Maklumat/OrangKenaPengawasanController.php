<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;

class OrangKenaPengawasanController extends Controller {

    public function getOrangKenaPengawasan(){
        $data = Maklumat::getOrangKenaPengawasan();
        $response = array(
            'quantiti_pesalah' => count($data),
            'pesalah' => $data
        );
        return response()->json($response);
    }
}