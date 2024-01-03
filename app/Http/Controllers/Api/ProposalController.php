<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProposalRequest;

class ProposalController extends Controller
{
    public function store(StoreProposalRequest $request) {
        $data = $request->validated();

        //ho ricevuto i dati validati dal client
        dd($request);

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

        $informations = $data['informations'];

    }
}
