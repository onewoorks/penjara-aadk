<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use App\Models\Aadk\Maklumat;

class DadahController extends Controller {

    public function getDadah(){
        $data = Maklumat::getDadah();
        $response = array(
            'quantiti_pesalah' => count($data),
            'pesalah' => $data
        );
        return response()->json($response);
    }
}