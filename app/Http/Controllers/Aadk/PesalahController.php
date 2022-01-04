<?php 

namespace App\Http\Controllers\Aadk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Aadk\Pesalah;

class PesalahController extends Controller{

    public function getNoByIc(Request $request){
        $data = $request->getContent();
        $pesalah = Pesalah::getPesalah();
        return response()->json(json_decode($pesalah));
    }
}