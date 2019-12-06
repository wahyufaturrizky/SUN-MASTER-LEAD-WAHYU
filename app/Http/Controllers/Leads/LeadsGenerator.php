<?php

namespace App\Http\Controllers\Leads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadsGenerator extends Controller
{
    public function index()
    {
        return view('pages.leads.registration');
    }
}
