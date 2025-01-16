<?php

namespace App\Http\Controllers;

use App\Models\Cardano;
use Illuminate\Http\Request;

class CardanoController extends Controller
{
    public function index()
    {
        return Cardano::all();
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

        return Cardano::create($data);
    }

    public function show(Cardano $cardano)
    {
        return $cardano;
    }

    public function update(Request $request, Cardano $cardano)
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

        $cardano->update($data);

        return $cardano;
    }

    public function destroy(Cardano $cardano)
    {
        $cardano->delete();

        return response()->json();
    }
}
