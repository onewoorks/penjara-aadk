<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use App\Models\Aadk\Maklumat;

class PrestasiController extends Controller {

    public function getPrestasi(){
        $data = Maklumat::getPrestasi();
        $response = array(
            'quantiti_pesalah' => count($data),
            'pesalah' => $data
        );
        return response()->json($response);
    }
}