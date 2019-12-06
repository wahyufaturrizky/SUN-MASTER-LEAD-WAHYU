<?php

namespace App\Http\Controllers\Auth\SunSafe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginController extends Controller
{
    public function login(){
        $login_token = $_GET['login_token'];
        $data = array ("login_token" => $login_token);
        // URL sunsafe untuk melakukan proses login
        // $url = "http://sunbox.suneducationgroup.com/security_api/v2/login";
        $url = "http://sunsafe.suneducationgroup.com/security_api/v2/login";
        $cr = curl_init($url);
        curl_setopt ($cr, CURLOPT_POST, 1);
        curl_setopt ($cr, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cr, CURLOPT_HTTPHEADER, array(
            // 'X-Sunsafe-Api-ID: 20',
            // 'X-Sunsafe-Api-Token: 3ZQZ3WI1KZTVYV24WUW7C1I7YB4W2Q0LV8N3JD39LT4B1L8IO3',
            // 'X-Sunsafe-Api-Secret: 357QLE82TJX5RA33JUXE43MH22TJ17GZXLB1ANWYRD3BHAMZER',
            'X-Sunsafe-Api-ID: 20',
            'X-Sunsafe-Api-Token: 3ND92UE3WATLKQ1DBF7UG17TW69S24LD62D3Q7M4DO1K34NFF1',
            'X-Sunsafe-Api-Secret: 2G7D9AJ2T1QE3K32YM5UK2F7X9HE1GHEGNS43C81HI1E0CZQX4',
            'Content-Type: text/plain'
        ));
        curl_setopt($cr, CURLOPT_POSTFIELDS, json_encode($data) );

        $json_result  = curl_exec($cr);

        $data = json_decode($json_result);

        if($data->error_code == 0){
            if(isset($data->payload->user_data)){
                $userData = $data->payload->user_data;
                $user = User::where('email',$userData->email)->first();
                if(!is_null($user)){
                    // dd($user);
                    Auth::loginUsingId($user->id);
                    return redirect()->intended('dashboard');
                }

            }
            // dd($data->payload->user_data);
            // dd(isset($data->payload));
            // if($data->pay)
        } else {
            dd($data);
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
        }
    }
}
