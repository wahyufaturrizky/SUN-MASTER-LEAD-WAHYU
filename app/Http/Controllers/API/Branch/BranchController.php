<?php

namespace App\Http\Controllers\API\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Branch;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchCollection;

class BranchController extends Controller
{
    public function getData(){
        $branches = Branch::all();
        return new BranchCollection($branches);
    }
}
