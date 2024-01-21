<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index() {
        $proposals = Proposal::all();

        return view('contacts.proposals',[
            'proposals' => $proposals
        ]);
    }

    public function show($id) {
        $proposal = Proposal::findOrFail($id);

        $labels = [
            'Brand',
            'Model',
            'Reference',
            'Movement',
            'Case material',
            'Strap/bracelet material',
            'Original strap/bracelet',
            'Original bracelet buckle/clasp',
            'Production year',
            'State of wear of the watch',
            'Do you still have the original watch box?',
            'Do you still have the original watch warranty?'
        ];

        return view('contacts.proposal-show', [
            'labels' => $labels,
            'proposal' => $proposal
        ]);
    }

    public function destroy($id) {
        $proposal = Proposal::findOrFail($id); 

        if ($proposal->photo1) {
            if (Storage::exists($proposal->photo1)) {
                Storage::delete($proposal->photo1);
            }
        }

        if ($proposal->photo2) {
            if (Storage::exists($proposal->photo2)) {
                Storage::delete($proposal->photo2);
            }
        }

        if ($proposal->photo3) {
            if (Storage::exists($proposal->photo3)) {
                Storage::delete($proposal->photo3);
            }
        }

        $proposal->delete();

        return redirect()->route('proposals');
    }
}