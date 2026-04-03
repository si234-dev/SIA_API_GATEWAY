<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function generate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $token = ApiToken::create([
            'name'  => $request->name,
            'token' => Str::random(40)
        ]);

        return response()->json($token, 201);
    }

    public function list()
    {
        return response()->json(ApiToken::all(), 200);
    }

    public function delete($id)
    {
        $token = ApiToken::findOrFail($id);
        $token->delete();
        return response()->json(['message' => 'Token deleted'], 200);
    }
}