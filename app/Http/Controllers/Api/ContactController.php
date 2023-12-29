<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email',
            'message' => 'nullable|string|min:30'
        ]);

        return response()->json([
            'result' => $data,
            'success' => true
        ]);
    }
}
