<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);

        $data = $request->all();
        Mail::to('info@studioonejo.com')->send(new ContactMail($data));
        return back()->with('success', 'Your message has been sent successfully.');
    }
}
