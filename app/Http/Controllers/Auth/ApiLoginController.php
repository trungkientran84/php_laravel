<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * This controller handle login for the api client based on email and password using passport
 * Class ApiLoginController
 * @package App\Http\Controllers\Auth
 */
class ApiLoginController extends Controller
{
    /**
     * Login the user through api
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        //get username and password from the request
        $credentials = $request->only('email', 'password');

        //Authenticate user
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();

            //Generate the token for this user
            $token = $user->createToken('Token Name')->accessToken;

            //Return some basic information of user along with token.
            //The client will use this token to access the api
            $result = (object) [
                'status' => 'SUCCESS',
                'token' => $token,
                'id'=>$user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => "/storage/" . $user->avatar
            ];
            return response()->json($result);
        } else {
            //Authentication fail, then return the result to client
            $result = (object) [
                'status' => 'FAIL'
            ];
            return response()->json($result );
        }
    }

    /**
     * This method return the current user based on provided token
     * @param Request $request
     * @return mixed
     */
    public function user(Request $request){

        return auth()->guard('api')->user();
    }
}
