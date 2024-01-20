<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();

        return view('contacts.messages', [
            "contacts" => $contacts
        ]);
    }

    public function destroy($id) {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->route('contacts');
    }
}