<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;

class EventRegistrationController extends Controller
{
    public function index($slug)
    {
        
        // $eventRegistration_data = \App\EventRegistration::all();

        // return view('pages.eventregistration.index',['eventRegistration_data' => $eventRegistration_data]);

        $form_id = \App\Form::where('slug', $slug)->get();

        return view('pages.eventregistration.index', compact('form_id'));

    }

    public function index2($slug)
    {
        
        // $eventRegistration_data = \App\EventRegistration::all();

        // return view('pages.eventregistration.index',['eventRegistration_data' => $eventRegistration_data]);

        $form_id = \App\Form::where('slug', $slug)->get();

        return view('pages.eventregistration2.index', compact('form_id'));


    }

    public function create(Request $request)
    {
        \App\EventRegistration::create($request->all());
        
        return view('thankyou');
    }

    public function view($form_id)
    {
        // $events = \App\EventRegistration::find($form_id);

        $events = \App\EventRegistration::where('form_id',$form_id)->get();
        
        return view('pages.eventregistration.view', compact('events'));
    }

    public function details($id)
    {
        $user = \App\EventRegistration::find($id);
        return view('pages.eventregistration.details', compact('user'));
    }
    
}
