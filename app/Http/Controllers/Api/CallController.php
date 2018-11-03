<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;


class CallController extends ApiController
{
    public function makeCall(CallRequest $request)
    {
        $callerPhoneNumber = $request->get("caller_phone_number");
        $calleePhoneNumber = $request->get("callee_phone_number");

        if(!$calleePhoneNumber)
        {
            //TODO get callee phone number from callee_id
            $calleeUserId = $request->get("callee_id");
        }
        if(!$callerPhoneNumber)
        {
            //TODO get caller phone number from current authenticated user
        }

        if(strpos($callerPhoneNumber, '0') == 0) {
            $callerPhoneNumber = preg_replace('/0/', '+234', $callerPhoneNumber, 1);
        }

        if(strpos($calleePhoneNumber, '0') == 0) {
            $calleePhoneNumber = preg_replace('/0/', '+234', $calleePhoneNumber, 1);
        }

        $authorization = Config::get('constants.infobip.app_authorization');
        $baseUrl = Config::get('constants.infobip.base_url');
        $callPath = Config::get('constants.endpoints.call');

        $message = ',';
        $data = [
            "bulkId" => "BULK-ID-123-xyz",
            'messages' => [
                [
                    "messageId"=> "MESSAGE-ID-" . str_random(3) . "-" . str_random(3),
                    'from' => '41793026700',
                    'destinationA' => $callerPhoneNumber,
                    'destinationB' => $calleePhoneNumber,
                    'text' => $message,
                    "language"=> "en",
                    "record"=> false,
                    "anonymization"=> false,
                    "notifyUrl"=> url('/' ) . "/api/v1/calls/infobip/notifications",
                    "notifyContentType"=> "application/json"
                ]
            ]
        ];

        $headers = [
            'Authorization' => $authorization,
            'Accept' => 'application/json',
        ];


        $result = makePostRequest($baseUrl . $callPath, $data, $headers);

        Log::debug($result);

        if($result['code'] > 299){
            return createResponse("Error starting call.", $result['code'], [
                'from' => $callerPhoneNumber,
                'to' => $calleePhoneNumber,
                'result' => $result['response']
            ]);
        }

        return createResponse("Call Initiated", 200, [
            'from' => $callerPhoneNumber,
            'to' => $calleePhoneNumber,
            'result' => $result
        ]);

    }

    public function receiveCallStatus(Request $request)
    {
        Log::debug($request->all());
    }
}
