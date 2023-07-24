<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use App\Models\Contact;
class ContactController extends Controller
{
    public function showContact()
    {
        return view('frontend.contact.index');
    }

    public function submitContactForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $validatedData = array_merge($validatedData,['status'=>0]);
        // Create a new Contact instance and save it to the database
        $contact = Contact::create($validatedData);

        // Send the email
        Mail::to('mp753114@gmail.com')->send(new ContactEmail($contact));

        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }
}
