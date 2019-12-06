<?php

namespace App\Http\Controllers\EmailVerification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailVerificationController extends Controller
{
    private $baseURL = 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=[email]&ext=1';

    public function ccc(){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://myexample.com');
        $response = $request->getBody();
    }
