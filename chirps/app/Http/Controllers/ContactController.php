<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create(): View
    {
        if (Auth::check()) {
            // Return a view with only the message field for authenticated users
            return view('contact.form_auth');
        } else {
            // Return a view with the full form for guests
            return view('contact.form_guest');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => Auth::check() ? 'nullable|string' : 'required|string',
            'last_name' => Auth::check() ? 'nullable|string' : 'required|string',
            'email' => Auth::check() ? 'nullable|email' : 'required|email',
            'message' => 'required|string|max:255',
        ]);

        // Create a new Contact instance with the validated data
        $contact = new Contact([
            'first_name' => $validated['first_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'],
        ]);

        // $contact = new Contact([
        //     'first_name' => $request->filled('first_name') ? $validated['first_name'] : null,
        //     'last_name' => $request->filled('last_name') ? $validated['last_name'] : null,
        //     'email' => $request->filled('email') ? $validated['email'] : null,
        //     'message' => $validated['message'],
        // ]);

        if (Auth::check()) {
            $contact->user_id = Auth::id();
        }

        // Save the contact to the database
        $contact->save();

        return redirect(route('dashboard'));
    }
}


// single route using match. maunual controller file creation
// class ContactController extends Controller
// {
//     public function contact(Request $request)
//     {
//         if ($request->isMethod('get')) {
//             return view('contact.form');
//         } else {
//             $rules = [
//                 'name' => 'required',
//                 'email' => 'required|email',
//                 'message' => 'required',
//             ];

//             $validatedData = $request->validate($rules);

//             // Send email (you can customize this part)
//             Mail::send('emails.contact', $validatedData, function ($message) use ($validatedData) {
//                 $message->subject('Contact Form');
//                 $message->from($validatedData['email'], $validatedData['name']);
//                 $message->to('your-email@example.com');
//             });

//             return redirect('/contact')->with('success', 'Thank you for your message. We will contact you shortly.');
//         }
//     }
// }


// different routes for get and store. manual form creation
// class ContactController extends Controller
// {
//     public function create()
//     {
//         return view('contact.form');
//     }

//     public function store(Request $request)
//     {
//         // Validation rules
//         $rules = [
//             'name' => 'required',
//             'email' => 'required|email',
//             'message' => 'required',
//         ];

//         // Validate the request
//         $request->validate($rules);

//         // Send email (you can customize this part)
//         Mail::send('emails.contact', $request->all(), function ($message) use ($request) {
//             $message->subject('Contact Form');
//             $message->from($request->email, $request->name);
//             $message->to('your-email@example.com');
//         });

//         // Redirect back with success message
//         return redirect('/contact')->with('success', 'Thank you for your message. We will contact you shortly.');
//     }
// }