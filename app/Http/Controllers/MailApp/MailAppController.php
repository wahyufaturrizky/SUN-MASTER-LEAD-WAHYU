<?php

namespace App\Http\Controllers\MailApp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailAppController extends Controller
{
    public function getFormSunnies(){
        return view('pages.mailapp.formsunnies');
    }
}
