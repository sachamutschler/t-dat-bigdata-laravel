<?php

namespace App\Http\Controllers;

use App\Models\Ripple;
use Illuminate\Http\Request;

class RippleController extends Controller
{
    public function index()
    {
        return Ripple::all();
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

        return Ripple::create($data);
    }

    public function show(Ripple $ripple)
    {
        return $ripple;
    }

    public function update(Request $request, Ripple $ripple)
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

        $ripple->update($data);

        return $ripple;
    }

    public function destroy(Ripple $ripple)
    {
        $ripple->delete();

        return response()->json();
    }
}
