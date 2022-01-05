<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use App\Models\Aadk\Maklumat;

class SejarahLampauController extends Controller {

    public function getSejarahLampau(){
        $data = Maklumat::getSejarahLampau();
        $response = array(
            'quantity_pesalah' => count($data),
            'pesalah' => $data
        );
        return response()->json($response);
    }
}