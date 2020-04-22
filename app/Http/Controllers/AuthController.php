<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $password = $request->input("password");
 
        $user = User::where("email", $email)->first();
 
        if (!$user) {
            $out = [
                "message" => "login_vailed",
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
                "message" => "login_vailed",
                "code"    => 401,
                "result"  => [
                    "api_token" => null,
                ]
            ];
        }
 
        return response()->json($out, $out['code']);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|unique:users|max:255',
            'password'  => 'required|min:6',
            'name'      => 'required',
            'role'      => 'required',
            'status'    => 'required'
        ]);
        $email      = $request->input("email");
        $password   = $request->input("password");
        $name       = $request->input("name");
        $role       = $request->input("role");
        $status     = $request->input("status");

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
                "message" => "vailed_regiser",
                "code"   => 404,
            ];
        }

        return response()->json($out, $out['code']);
    }
}