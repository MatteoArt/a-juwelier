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
        dd($data);
    }
}
