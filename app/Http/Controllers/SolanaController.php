<?php

namespace App\Http\Controllers;

use App\Models\Solana;
use Illuminate\Http\Request;

class SolanaController extends Controller
{
    public function index()
    {
        return Solana::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'symbol' => ['required'],
            'price' => ['required', 'numeric'],
            'market_cap' => ['required', 'numeric'],
            'volume' => ['required', 'numeric'],
            'change_1h' => ['required'],
            'change_24h' => ['required'],
            'change_7d' => ['required'],
        ]);

        return Solana::create($data);
    }

    public function show(Solana $solana)
    {
        return $solana;
    }

    public function update(Request $request, Solana $solana)
    {
        $data = $request->validate([
            'name' => ['required'],
            'symbol' => ['required'],
            'price' => ['required', 'numeric'],
            'market_cap' => ['required', 'numeric'],
            'volume' => ['required', 'numeric'],
            'change_1h' => ['required'],
            'change_24h' => ['required'],
            'change_7d' => ['required'],
        ]);

        $solana->update($data);

        return $solana;
    }

    public function destroy(Solana $solana)
    {
        $solana->delete();

        return response()->json();
    }
}
