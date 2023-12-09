<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index() {

        $watches = Watch::all();

        return response()->json([
            'results' => $watches
        ]);
    }

    public function show($slug) {
        $watch = Watch::where('slug', $slug)->first();

        return response()->json($watch);
    }
}
