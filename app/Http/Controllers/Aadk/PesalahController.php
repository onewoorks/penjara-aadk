<?php 

namespace App\Http\Controllers\Aadk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesalahController extends Controller{

    public function getNoByIc(Request $request){
        $data = $request->getContent();
        return response()->json(json_decode($data));
    }
}