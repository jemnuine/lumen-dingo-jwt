<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Auth Controller constructor.
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function postLogin(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = $this->auth->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function deleteLogin(Request $request)
    {
        $token = $this->auth->getToken();

        return $this->auth->invalidate($token);
    }
}
