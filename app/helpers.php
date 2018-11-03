<?php
/**
 * Created by PhpStorm.
 * User: Tjohn
 * Date: 10/11/18
 * Time: 2:42 PM
 */

function isValidPhoneNumber($phoneNumber){
    if(!$phoneNumber || empty($phoneNumber) || !preg_match("/^[0-9+]{6,14}$/", $phoneNumber)) {
        return false;
    }
    return true;
}

function createResponse($message, $code, $data = null){
    return response()->json([
        'message' => $message,
        'code' => $code,
        'data' => $data
    ], $code);
}

function httpBuildQueryForCurl( $arrays, &$new = array(), $prefix = null )
{
    if ( is_object( $arrays ) ) {
        $arrays = get_object_vars( $arrays );
    }

    foreach ( $arrays AS $key => $value ) {
        $k = isset( $prefix ) ? $prefix . '[' . $key . ']' : $key;
        if ( is_array( $value ) OR is_object( $value )  ) {
            httpBuildQueryForCurl( $value, $new, $k );
        } else {
            $new[$k] = $value;
        }
    }
}


function makePostRequest($url, $data, $headers = [])
{
    $h = [];
    foreach ($headers as $k => $v)
    {
        $h[] = $k . ': ' . $v;
    }
    // Add content-type as json
    $h[] = "Content-Type: application/json";

    \Illuminate\Support\Facades\Log::debug("POST request headers: " . json_encode($headers));
    \Illuminate\Support\Facades\Log::debug("POST request body: " . json_encode($data));


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    httpBuildQueryForCurl($data, $transformed);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $error = curl_error($ch);
    $errorNumber = curl_errno($ch);


    curl_close($ch);

    return [
        'response' => $error ? $error : $response ,
        'code' => $error ? $errorNumber : $httpCode
    ];
}