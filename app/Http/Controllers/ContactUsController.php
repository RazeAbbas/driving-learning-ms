<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactFormSubmission;
use App\Mail\ContactFormMail;

class ContactUsController extends Controller
{
    private $singular = "Contact Us";
    public function index()
    {
        $data = array(
            'page_title' => $this->singular,
        );
        return view('contact-us.contact-us',$data);
    }
    public function sendEmail(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        
        // Store the form data
        $submission = ContactFormSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        
        // Prepare data for the email view
        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => $submission->created_at, // Include creation date
            'page_title' => $this->singular,
        ];
        
        // Send email to admin
        Mail::to('razeabbas8780@gmail.com')->send(new ContactFormMail($formData));
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

