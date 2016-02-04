<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
// use App\Http\Requests;
// use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller {

    public function getForm()
    {
        return view('contact.contact');
    }

    public function postForm(ContactRequest $request)
    {
        Mail::send('emails.contact', $request->all(), function($message) 
        {
            $message->to('angebert.marc@gmail.com')->subject('Contact');
        });

        return view('contact.confirm');
    }

}