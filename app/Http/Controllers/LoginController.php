<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Users;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.auth.login');
    }

    public function login (Request $request) {

        $required = ['username', 'password'];

        foreach ($required as $field) {
            if (!$request->has($field)) {
                return response()->json([
                    'error' => $field . ' field is required.'
                ], 422);
            }
        }
        $verify_user = $this->verify($request); 

        if(!$verify_user['error']){
            
            session(['user_data'=> $verify_user['data']]);
            
            $role = $verify_user['data']->role;

            switch ($role) {
                case 1: 
                    return redirect()->route('admin.dashboard');
                    break;
                case 2:
                    return redirect()->route('responder.dashboard');
                    break;
                case 3:
                    return redirect()->route('secretary.dashboard');
                    break;

                default:
                    return redirect()->back()->with('error', 'Role doesn\'t exist');
            }
        }

        return response()->json([
            'error' => true,
            'message' => $verify_user['message']
        ]);

    }

    private function verify ($request) {

        $password = $request->password;

        $user_data = Users::select("firstname", "lastname", "username", "password", "emailaddress", "role", "status")
                    ->where("username", $request->username)
                    ->first();

        if($user_data->status == 1) {

            if (Hash::check($password, $user_data->password)) {
                return [
                    'error' => false,
                    'data' => json_decode($user_data),
                ];
            }

        }else if($user_data->status == 2){
            return [
                'error' => true,
                'message' => '407: Your account has been deleted!'
            ];
        }

        return [
            'error' => true,
            'message' => '407: This account does not exist!'
        ];

    }
}
