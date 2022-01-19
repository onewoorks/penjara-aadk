<?php 

namespace App\Http\Controllers\Imigresen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Imigresen\Pesalah;
use App\Traits\RequestResponse;
use App\Traits\HmpkErrors;
use App\Traits\MockData;

class PesalahController extends Controller{

    use RequestResponse;
    use HmpkErrors;
    use MockData;

    public function getPesalah(Request $request){
        $data           = json_decode($request->getContent());
        $request        = $this->validateRequest($data);
        $data->hpmk_message->hpmk_message_payload = (Object) array();
        if($request->status == 'success'){
            $mode_carian = $this->modeCarian($request->message);
            if($mode_carian){
                $pesalah = array();
                $data->hpmk_message->hpmkmessage_payload = (Object) array();
                $data->hpmk_message->hpmk_message_payload->hpmk_data  = $this->finalResult($pesalah);
            } else {
                $data->hpmk_message->hpmk_message_payload->hpmk_error = $this->validateCarian();
            }
        } else {
            $data->hpmk_message->hpmk_message_payload->hpmk_error = $request->message->hmpk_error;
        }
        return response()->json($data);
        
    }

    private function modeCarian($message){
        $carian = false;
        $mode = false;
        $valid = (count((array)$message) == 1) ? true: false;
        if($valid){
            $mode = isset($message->smpp_no)  ? ['mode' => 'SmppNo', 'value' => $message->smpp_no] : $mode;
            $mode = isset($message->passport) ? ['mode' => 'Passport', 'value' => $message->passport] : $mode;
            if($mode){
                $getMode = $mode['mode'];
                $method = "getPesalahBy$getMode";
                $carian = $this->$method($mode['value']);
            }
        }
        return $carian;
    }

    private function getPesalahBySmppNo($smpp_no){
        return Pesalah::getPesalahSmppNo($smpp_no);
    }

    private function getPesalahByPassport($passport){
        return Pesalah::getPesalahPassport($passport);
    }

    private function validateCarian(){
        $not_valid = true;
        return ($not_valid) ? [
            "errorCode"         => "error",
            "errorDescription"  => "Search identification parameter is not valid, request only accept one searching mode with smpp_no or passport key only."] : true;
    }

}