<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class ContactController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email',
            'message' => 'nullable|string|min:30'
        ]);

        //creo il nuovo contatto per poi salvarlo a db
        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();

        //invio la mail
        $admin_mail = 'admin.mail@gmail.com';
        Mail::to($admin_mail)->send(new NewContact($data));

        return response()->json([
            "response" => "Thanks you {$data['name']} for contacting us, we'll be in touch very soon"
        ], 201);
    }
}
