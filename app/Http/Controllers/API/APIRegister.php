<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\Base as Base;
use App\User;
use Dotenv\Validator;
use http\Env\Response;


class APIRegister extends Base
{
    public function register(Request $request){

        $validator =\Validator::make($request->all(),[
            'email'=>'required | email | max:255 | unique:users',
            'name'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return $this->errorResponse('error validation',$validator->errors());
        }else{
          $user = User::create([
                'name'=>$request->get('name'),
                'email'=>$request->get('email'),
                'password'=>bcrypt($request->get('password'))
            ]);

            $success['token']=$user->createToken('MyApp')->accessToken;
            $success['name']=$user->name;
            return $this->sendResponse($success,'user added');
        }
    }
}
