<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;

class ProposalController extends Controller
{
    public function index() {
        $proposals = Proposal::all();

        return view('contacts.proposals',[
            'proposals' => $proposals
        ]);
    }
}
