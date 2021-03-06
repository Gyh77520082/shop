<?php

namespace App\Exceptions;
use Illuminate\Http\Request;

use Exception;

class InvalidRequestException extends Exception
{
    //
    public function __construct(string $message="", int $code = 400){
        parent::__construct($message, $code);
    }



    public function render(Request $request){
        if($request->expectsJson()){
            // json() 方法第二个参数就是 Http 返回码
            return respone()->json(['msg' => $this->message], $this->code);
        }

        return view('pages.error', ['msg' => $this->message]);
    }
}
