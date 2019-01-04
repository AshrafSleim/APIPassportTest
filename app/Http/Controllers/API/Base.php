<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class Base extends Controller
{
    public function sendResponse($result,$message){

        $response=[
            'success'=>'true',
            'data'=>$result,
            'message'=>$message
        ];
        return response()->json($response,200);
    }
    public function errorResponse($error,$messages=[]){

        $response=[
            'success'=>'false',
            'message'=>$error
        ];
        if (!empty($messages)){
            $response['data']= $messages;
        }
        return response()->json($response,404);
    }
}
