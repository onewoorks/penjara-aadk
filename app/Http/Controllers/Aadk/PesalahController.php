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
        $data = $request->getContent();
        $pesalah = Pesalah::getPesalah();
        $data = array(
            'pesalah' => $pesalah,
        );
        return response()->json($data);
    }
}