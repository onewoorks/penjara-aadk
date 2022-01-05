<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use App\Models\Aadk\Maklumat;

class HadirProgramController extends Controller {

    public function getHadirProgram(){
        $data = Maklumat::getHadirProgram();
        $response = array(
            'quantity' => count($data),
            'pesalah' => $data
        );
        return response()->json($response);
    }
}