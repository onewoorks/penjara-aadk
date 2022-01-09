<?php 

namespace App\Http\Controllers\Aadk\Maklumat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Aadk\Maklumat;
use App\Traits\RequestResponse;
use App\Traits\HmpkErrors;
use App\Traits\MockData;

class HadirProgramController extends Controller {

    use RequestResponse;
    use HmpkErrors;
    use MockData;

    public function getHadirProgram(Request $request){
        $data           = json_decode($request->getContent());
        return $this->withHpmkFormat($data);
    }

    public function withHpmkFormat($data){
        $request = $this->validateRequest($data);
        $data->hpmk_message->hpmk_message_payload = (Object) array();
        if($request->status == 'success'){
            $valid_ic       = $this->validateIdentification($request->message->kp);
            if(!$valid_ic){
                $nric       = $this->cleaningIcPayload($request->message->kp);
                $pesalah    = env('MOCK_DATA') ? $this->mockHadirProgram() : Maklumat::getHadirProgram($nric);
                $data->hpmk_message->hpmk_message_payload = (Object) array();
                $data->hpmk_message->hpmk_message_payload->hpmk_data  = $this->finalResult($pesalah);
            } else {
                $data->hpmk_message->hpmk_message_payload->hpmk_error = $valid_ic;
            }
        } else {
            $data->hpmk_message->hpmk_message_payload->hpmk_error = $request->message->hmpk_error;
        }
        return response()->json($data);
    }

}