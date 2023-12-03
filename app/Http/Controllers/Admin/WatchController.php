<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index() {

        //recupero tutti gli orologi dal db
        $watches = Watch::all();

        return view('dashboard', [
            'watches' => $watches
        ]);
    }
}
