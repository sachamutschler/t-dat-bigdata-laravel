<?php

namespace App\Http\Controllers;

use App\Models\Ethereum;
use Illuminate\Http\Request;

class EthereumController extends Controller
{
    public function index()
    {
        return Ethereum::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'symbol' => ['required'],
            'price' => ['required', 'numeric'],
            'market_cap' => ['required', 'numeric'],
            'volume' => ['required', 'numeric'],
            'change_1h' => ['required', 'numeric'],
            'change_24h' => ['required', 'numeric'],
            'change_7d' => ['required', 'numeric'],
        ]);

        return Ethereum::create($data);
    }

    public function show(Ethereum $ethereum)
    {
        return $ethereum;
    }

    public function update(Request $request, Ethereum $ethereum)
    {
        $data = $request->validate([
            'name' => ['required'],
            'symbol' => ['required'],
            'price' => ['required', 'numeric'],
            'market_cap' => ['required', 'numeric'],
            'volume' => ['required', 'numeric'],
            'change_1h' => ['required', 'numeric'],
            'change_24h' => ['required', 'numeric'],
            'change_7d' => ['required', 'numeric'],
        ]);

        $ethereum->update($data);

        return $ethereum;
    }

    public function destroy(Ethereum $ethereum)
    {
        $ethereum->delete();

        return response()->json();
    }
}
