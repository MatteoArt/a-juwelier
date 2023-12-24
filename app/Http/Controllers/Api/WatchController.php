<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index(Request $request) {

        //recupero la ricerca che mi viene passata dal front end
        $filter = $request->query('searchWatch');

        $query = Watch::query();
        

        //se viene passata una query string allora la ricerca per filtro viene applicata
        if ($filter) {
            //costruisco la query per poi eseguirla
            $watches = $query->where('brand', 'like', '%' . $filter . '%')
            ->orWhere('model', 'like', '%' . $filter . '%')
            ->orWhere('ref', 'like', '%' . $filter . '%')->get();
            
        } else { //se non viene settata la ricerca allora restituisco tutti gli orologi
            $watches = Watch::all();
        }

        
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
