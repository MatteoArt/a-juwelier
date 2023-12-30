<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use App\Mail\MailToUser;

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

        //invio la mail all'amministratore per notificarlo di un nuovo messaggio dal suo
        //sito
        $admin_mail = 'admin.mail@gmail.com';
        Mail::to($admin_mail)->send(new NewContact($data));

        //invio anche una mail di conferma all'utente che ha compilato il form
        Mail::to($data['email'])->send(new MailToUser($data));

        //ritorno un messaggio di successo al front end
        return response()->json([
            "response" => "Message sent successfully. We will get back to you shortly!"
        ], 201);
    }
}
