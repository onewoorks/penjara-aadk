<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use App\Models\Aadk\Maklumat;

class SejarahLampauController extends Controller {

    public function getSejarahLampau(){
        $data = Maklumat::getSejarahLampau();
        return response()->json($data);
    }
}