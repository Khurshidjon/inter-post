<?php

namespace App\Http\Controllers\API;

use App\User;
use Dotenv\Parser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::firstOrNew(['email' => $request->email]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $http = new Client();
        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'UnRDxiWjGcNBZYnseffMhnCuJ9DoLfbMQByBSyPb',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]
        ]);
        return response()->json(['data' => json_decode((string)$response->getBody(), true)]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user){
            return response()->json('User not found', 404);
        }
        if (Hash::check($request->password, $user->password)){
            $http = new Client();
            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'UnRDxiWjGcNBZYnseffMhnCuJ9DoLfbMQByBSyPb',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ]
            ]);
            return response()->json(['data' => json_decode((string)$response->getBody(), true)]);
        }
    }
    protected function guard()
    {
        return Auth::guard('api');
    }

//    public function logout(Request $request)
//    {
//        if (!$this->guard()->check()) {
//            return response([
//                'message' => 'No active user session was found'
//            ], 404);
//        }
//
//        // Taken from: https://laracasts.com/discuss/channels/laravel/laravel-53-passport-password-grant-logout
//        $request->user('api')->token()->revoke();
//
//        Auth::guard()->logout();
//
//        Session::flush();
//
//        Session::regenerate();
//
//        return response([
//            'message' => 'User was logged out'
//        ]);
//    }
    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);
        $accessToken->revoke();
        return response(null, 204)->cookie(Cookie::forget('refreshToken'));
    }
}
