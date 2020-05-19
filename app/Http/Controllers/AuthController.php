<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator, Input, Redirect; 

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            $out = [
                "message" => "login_failed",
                "code"    => 401,
                "error"  => $validator->errors()
            ];
        }else {
            $email = $request->input("email");
            $password = $request->input("password");
    
            $user = User::where("email", $email)->first();
    
            if (!$user) {
                $out = [
                    "message" => "login_failed",
                    "code"    => 401,
                    "result"  => [
                        "api_token" => null,
                    ]
                ];
                return response()->json($out, $out['code']);
            }
    
            if (Hash::check($password, $user->password)) {
                $newtoken  = \Illuminate\Support\Str::random(64);

                $user->update([
                    'api_token' => $newtoken
                ]);
    
                $out = [
                    "message" => "login_success",
                    "code"    => 200,
                    "result"  => $user
                ];
            } else {
                $out = [
                    "message" => "login_failed",
                    "code"    => 401,
                    "result"  => [
                        "api_token" => null,
                    ]
                ];
            }
        }
 
        return response()->json($out, $out['code']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users|max:255',
            'password'  => 'required|min:6|confirmed',
            'name'      => 'required',
        ]);

        if ($validator->fails()) {
            $out = [
                "message" => "failed_regiser",
                "code"    => 401,
                "error"  => $validator->errors()
            ];
        }else{
        
            $email      = $request->input("email");
            $password   = $request->input("password");
            $name       = $request->input("name");
            // $role       = $request->input("role");
            // $status     = $request->input("status");
            $role       = 'member';
            $status     = 1;

            $hashPwd = Hash::make($password);

            $data = [
                "email"     => $email,
                "password"  => $hashPwd,
                'name'      => $name,
                'role'      => $role,
                'status'    => $status
            ];

            if ( User::create($data) ) {
                $out = [
                    "message" => "register_success",
                    "code"    => 201,
                ];
            } else {
                $out = [
                    "message" => "failed_regiser",
                    "code"   => 404,
                ];
            }
                
        }

        return response()->json($out, $out['code']);
    }
}
