<?php

namespace App\Http\Controllers\MarketingSource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MarketingSource;

class MarketingSourceController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->where('marketing_source_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->paginate(50);
            $search = '';
        }

        return view('pages.marketingsource.index', compact('marketingSources','search'));
    }

    public function add(){
        return view('pages.marketingsource.add');
    }

    public function postAdd(Request $req){
        $req->validate([
            'marketing_source_name' => 'required',
            'register_type' => 'required',
        ]);

        $marketingSource = new MarketingSource();
        $marketingSource->fill($req->all());
        $marketingSource->register_type = implode(',', $req->register_type);
        $marketingSource->save();

        return redirect(route('indexMarketingSource'));
    }

    public function edit($id){
        $marketingSource = MarketingSource::find($id);
        if(!is_null($marketingSource)){
            return view('pages.marketingsource.edit', compact('marketingSource'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'marketing_source_id' => 'required',
            'marketing_source_name' => 'required',
            'register_type' => 'required',
        ]);

        $marketingSource = MarketingSource::find($req->marketing_source_id);
        $marketingSource->marketing_source_id = $req->marketing_source_id;
        $marketingSource->fill($req->all());
        $marketingSource->register_type = implode(',', $req->register_type);

        if($marketingSource->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.marketingsource.edit', compact('marketingSource', 'saved'));
    }

    public function delete($id){
        $marketingSource = MarketingSource::find($id);
        if(!is_null($marketingSource)){
            return view('pages.marketingsource.delete', compact('marketingSource'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'marketing_source_id' => 'required',
        ]);

        $marketingSource = MarketingSource::find($req->marketing_source_id);
        $marketingSource->delete();

        return redirect(route('indexMarketingSource'));
    }

}
