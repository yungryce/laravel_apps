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
            return view('contact.form_auth');
        } else {
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

        if (Auth::check()) {
            $contact->user_id = Auth::id();
        }

        $contact->save();

        return redirect(route('dashboard'));
    }
}
