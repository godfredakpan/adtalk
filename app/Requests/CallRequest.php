<?php
/**
 * Created by PhpStorm.
 * User: Tjohn
 * Date: 10/11/18
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\Api;


use App\Requests\AppRequest;

class CallRequest extends AppRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "callee_id" => "numeric",
            "callee_phone_number" => "required_without:callee_id|phone",
            "caller_phone_number" => "phone"
        ];
    }
}