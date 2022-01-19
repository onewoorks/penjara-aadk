<?php

namespace App\Traits;

use App\Traits\HmpkErrors;

trait RequestResponse {

    use HmpkErrors;

    public function myGdxFormat($payload) {
        return array(
            "hpmk_message" => $this->hpmkMessage($payload->header),
            "hpmk_message_payload" => $this->hmpkMessagePayload($payload->response),
        );
    }

    private function hpmkMessage($payload) {
        return array(
            "hpmk_message_header"       => array(
                "messageSentDateTime"   => isset($payload->messageSentDateTime),
                "agencyCode"            => isset($payload->agencyCode) ? $payload->agencyCode : null,
                "serviceName"           => isset($payload->serviceName) ? $payload->serviceName : null,
                "serviceVersion"        => (String) isset($payload->serviceVersion) ? $payload->serviceVersion : null,
                "agencyAppAuthCode"     => (String) isset($payload->agencyAppAuthCode) ? $payload->agencyAppAuthKey : null,
                "agencyAppAuthKey"      => (String) isset($payload->agencyAppAuthKey) ? $payload->agencyAppAuthCode : null,
                "applicationCode"       => (String) isset($payload->applicationCode) ? $payload->applicationCode : null,
                "userUUID"              => (String) isset($payload->userUUID) ? $payload->userUUID : null,
                "userUUIDType"          => (String) isset($payload->userUUIDType) ? $payload->userUUIDType : null,
                "currentPageNum"        => isset($payload->currentPageNum) ? $payload->currentPageNum : null,
                "sessionID"             => isset($payload->sessionID) ? $payload->sessionID : null,
                "resMessageID"          => isset($payload->resMessageID) ? $payload->resMessageID : null,
                "compressedPayload"     => isset($payload->compressedPayload) ? $payload->compressedPayload : null,
                "totalPageNum"          => isset($payload->totalPageNum) ? $payload->totalPageNum : null,
                "transactionChecksum"   => isset($payload->transactionChecksum) ? $payload->transactionChecksum : null
            ));
    }

    private function hmpkMessagePayload($payload, $error = null){
        $response               = array();
        $response['hmpk_data']  = $payload;
        $response['hmpk_error'] = $error;
        return $response;
    }

    public function requestPayload($payload){
        return $payload;
    }

    public function validateRequest($payload){
        $header     = $payload->hpmk_message->hpmk_message_header;
        $valid      = $this->checkRequest($header);
        if(!$valid){
            $request    = $payload->hpmk_message->hpmk_message_payload;
            $response   = array(
                "status" => "success",
                "message" => $this->requestPayload($request)
            );   
        } else {
            $response   = array(
                "status" => "error",
                "message" => (Object) $this->responseError($header, $valid)
            ) ;
        }
        return  (Object) $response;
        
    }


    private function responseError($header, $error){
        return $this->hmpkMessagePayload($header, $error);
    }

    private function checkRequest($request){
        $valid = $this->validateAgencyAppAuth($request);
        return $valid;
    }
    private function validateAgencyAppAuth($request){
        $valid = array();
        if($request->agencyAppAuthCode == env('AGENCY_APP_AUTH_CODE') && $request->agencyAppAuthKey == env('AGENCY_APP_AUTH_KEY')){
            $valid = 0;
        } else {
            $valid = array(
                "errorCode" => '26',
                "errorDescription" => $this->errorRef('26')
            );
        }
        return $valid;
    }

    private function validateIdentification($identification_no, $identification_type = 'nric'){
        $valid = 0;
        $valid = strlen($identification_no) == 12 ? 0 : 1;
        return ($valid) ? [
            "errorCode"         => "error",
            "errorDescription"  => "identification_no is not valid, please do not include any special character, use number only."] : $valid;
    }

    private function cleaningIcPayload($payload){
        $ic_list = '';
        if (gettype($payload) != 'array'){
            $payload = array($payload);
        }
        $total_ics = count($payload);
        foreach($payload as $k=>$kp){
            $ic_list  .= "'" . strval($kp) . "'";
            $ic_list    .= (($k+1) < $total_ics) ? ',':'';
        }
        return $ic_list;
    }

       private function finalResult($payload){
        $response = array();
        if($payload){
            $records = array();
            foreach($payload as $p){
                $records[] = $p;
            }
            $response["records"] = $records;
        } else {
            $response["message"] = "Tiada rekod sepadan";
        }
        return $response;
    }

}