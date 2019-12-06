<?php

namespace App\Http\Controllers\SunEmailMarketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Remote\Mailapp\SMCustomerApiKey;

class EmailMarketingController extends Controller
{
    public function index($list_uid, $customer_uid){
        $apiKey = SMCustomerApiKey::where('customer_id', $customer_uid)->first();
        $public_key = $apiKey->public;
        $private_key = $apiKey->private;
        return view('pages.sunemailmarketing.form.index', compact('list_uid','customer_uid','public_key','private_key'));
    }
}
