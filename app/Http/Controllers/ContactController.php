<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display contact index page along with user contacts.
     */
    public function index()
    {
        return view('pages.contact.index', [
            'contacts' => User::find(Auth::id())->contacts()->orderBy('first_name', 'asc')->get()
        ]);
    }

    /**
     * Validate and store contact.
     */
    public function store(Request $request)
    {
        // Check if the email already exists in user's contact list.
        $contactExist = User::find(Auth::id())->contacts()->firstWhere('email', $request->email);

        if ($contactExist || !empty($contactExist)) {
            return redirect('contact')
                ->withErrors(['email_exists' => 'Contact already exists.']);
        }

        // Validate request.
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Store contact record.
        $contact = new Contact;
        $contact->user_id = Auth::id();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->save();

        return redirect()->back();
    }

    /**
     * Display appointment page along contact info.
     */
    public function appointment($id)
    {
        $contact = Contact::find($id);

        return view('pages.contact.appointment', [
            'appointments' => $contact->appointments()->orderBy('date_start', 'asc')->get(),
            'contact' => $contact,
        ]);
    }

    /**
     * Display contact edit page along with selected contact info.
     */
    public function edit($id)
    {
        return view('pages.contact.edit', ['contact' => Contact::find($id)]);
    }

    /**
     * Update selected contact.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        // Check if the user is trying to change the email.
        if ($request->email != $contact->email) {

            // Check if the email already exists in user's contact list.
            $contactExist = User::find(Auth::id())->contacts()->firstWhere('email', $request->email);

            if ($contactExist || !empty($contactExist)) {
                return redirect()
                    ->back()
                    ->withErrors(['email_exists' => 'Contact already exists.']);
            }
        }

        // Run check
        $this->contactOwner($contact);

        // Update contact
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->save();

        return redirect('contact');
    }

    /**
     * Delete contact record.
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        // Run check
        $this->contactOwner($contact);

        // Delete record.
        $contact->delete();
        return redirect()->back();
    }

    /**
     * Check if the logged user own this contact.
     */
    private function contactOwner($contact)
    {
        if ($contact->user_id != Auth::id()) {
            return redirect('home')
                ->withErrors(['action_denied' => 'The action was denied.']);
        }
    }
}
