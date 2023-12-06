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

    public function show($slug) {

        $watch = Watch::where('slug', $slug)->first();

        return view('watches.show', [
            'watch' => $watch
        ]);
    }

    public function create() {
        return view('watches.create');
    }

    public function store(Request $request) {
        $data = $request->all();

        $data['images'] = json_encode(explode(",", $data['images']));

        //aggiungi lo slug

        $newWatch = new Watch();
        $newWatch->fill($data);
        $newWatch->save();

        return redirect()->route('dashboard');
    }
}
