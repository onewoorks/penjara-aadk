<?php

namespace App\Http\Controllers\Mygdx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\RequestResponse;
use App\Traits\HmpkErrors;
use App\Traits\MockData;

class ClientController extends Controller {

    use RequestResponse;

    public function checkClient(Request $request) {
        $data       = json_decode($request->getContent());
        $params     = $this->validateRequest($data);
        $response   = $this->callMygdxClientCheck($data);
        return response()->json(json_decode($response));
    }

    public function aadkClientCheck(Request $request){
        $data       = json_decode($request->getContent());
        $header     = $data->smpp_username;
        $response   = array();
        $payload    = (object) array(
            "header"    => (object) array(
                "userUUID"      => $data->smpp_username,
                "userUUIDType"  => isset($data->smpp_username) ? "UID" : "OTHERS"
            ),
            "request"   => $data
        );
        $mygdx_request  = $this->requestMyGdxFormat($payload);
        $response       = $this->callMygdxClientCheck($mygdx_request);
        $result         = json_decode($response);
        $client         = $result->hpmk_message->hpmk_message_payload->hpmk_data->records;
        return response()->json(json_decode($client));
    }

    private function callMygdxClientCheck($payload) {
        $post_data = json_encode($payload);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://10.24.19.6:8080/cxf/aadkclientcheck/getAadkClientCheck',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}