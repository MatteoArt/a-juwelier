<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProposalRequest;
use App\Mail\ConfirmToUser;
use App\Models\Proposal;
use App\Mail\NewSellProposal;

use Illuminate\Support\Facades\Mail;

class ProposalController extends Controller
{
    public function store(StoreProposalRequest $request) {
        $data = $request->validated();

        //dd($data);
        //controllo se la request contiene l'immagine
        if ($request->has('photo1')) {
            $image_file1 = $request->file('photo1'); //recupero l'istanza di file
            //genero nome univoco
            $image_name1 = 'sell-image'.time().rand(1, 1000).'.'.$image_file1->getClientOriginalExtension();
            
            //salvo immagine nella cartella proposals
            $image_path1 = $image_file1->storeAs('proposals', $image_name1, 'public');

            //salvo il percorso a db
            $data['photo1'] = $image_path1;
        }

        if ($request->has('photo2')) {
            $image_file2 = $request->file('photo2');

            $image_name2 = 'sell-image'.time().rand(1, 1000).'.'.$image_file2->getClientOriginalExtension();

            $image_path2 = $image_file2->storeAs('proposals', $image_name2, 'public');

            $data['photo2'] = $image_path2;
        }

        if ($request->has('photo3')) {
            $image_file3 = $request->file('photo3');

            $image_name3 = 'sell-image'.time().rand(1, 1000).'.'.$image_file3->getClientOriginalExtension();

            $image_path3 = $image_file3->storeAs('proposals', $image_name3, 'public');

            $data['photo3'] = $image_path3;
        }

        $admin_mail = 'admin.mail@gmail.com';
        Mail::to($admin_mail)->send(new NewSellProposal($data));

        Mail::to($data['email'])->send(new ConfirmToUser($data));

        $informations = $data['informations'];

        $data['informations'] = json_encode($informations);

        $newProposal = new Proposal();
        $newProposal->fill($data);
        $newProposal->save();

        return response()->json([
            'response' => 'Request processed successfully, we will contact you as soon as possible'
        ], 201);
    }
}
