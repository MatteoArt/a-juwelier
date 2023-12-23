<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index(Request $request) {

        //recupero la ricerca che mi viene passata dal front end
        $filter = $request->query();

        $query = Watch::query();

        //se viene passata una query string allora la ricerca per filtro viene applicata
        if ($filter) {
            //costruisco la query per poi eseguirla
            $query->where('brand', 'like', "%$filter%");
        }

        $watches = Watch::all();

        return response()->json([
            'results' => $watches
        ]);
    }

    public function show($slug) {
        $watch = Watch::where('slug', $slug)->first();

        return response()->json([
            'result' => $watch
        ]);
    }
}
