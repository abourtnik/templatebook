<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller {

    public function index() {
        return view('contact.index');
    }

    public function send(Request $request) {

        $validation_contact = [

            'name' => 'required|min:1|max:255',
            'email' => 'required|email',
            'subject' => 'max:1',
            'message' => 'required|min:1|max:1000',
        ];

        $validator = Validator::make($request->all(), $validation_contact);

        if ($validator->passes() && $_SERVER['HTTP_REFERER'] === route('contact-index') ) {

            Mail::send('emails.contact', ['name' => $request->input('name') , 'bodyMessage' => $request->input('message')], function($message){
                $message->to('contact@antonbourtnik.fr')->subject('Contact sur TemplateBook');
            });

            return redirect(route('contact-index'))->with('success', 'Votre message a bien été envoyé !!');
        }

        else {
            return redirect(route('contact-index'))->withInput()->withErrors($validator->errors());
        }
    }
}

