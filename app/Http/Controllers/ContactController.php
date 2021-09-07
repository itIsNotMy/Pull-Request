<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function contacts()
    {
        return view('contacts');
    }

    public function adminFeedback()
    {
        $contacts = Contact::get();

        return view('admin.feedback', compact('contacts'));
    }

    public function store()
    {
        Contact::create($this->validate(request(), [
                            'email' => 'required|email',
                            'message' => 'required',
                        ])
        );

        return redirect(route('index'));
    }
}
