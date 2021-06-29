<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('front.contact');
    }

    public function store(ContactRequest $request)
    {
        try {
            Contact::create ([
                "user_id" => null,
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "message" => $request->get('message')
            ]);

            return back()->with ('status', 'Votre message a été enregistré, nous vous répondrons dès que possible.');
        }catch (\Exception $exception) {
            dd($exception);
        }


    }
}
