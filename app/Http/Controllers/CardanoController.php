<?php

namespace App\Http\Controllers;

use App\Models\Bitcoin;
use App\Models\Cardano;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function show(Cardano $cardano): JsonResponse
    {
        return response()->json($cardano);
    }

    /**
     * Get Cardano data by time (hour, day, week, month, year) from now.
     *
     * @param string $time
     * @param int|null $timeValue
     * @return JsonResponse
     */
    public function showByDate(string $time, ?int $timeValue): JsonResponse
    {
        if (!in_array($time, ['hours', 'days', 'weeks', 'months', 'years'])) {
            return response()->json(['message' => 'Invalid time unit'], 400);
        }
        try {
            $crypto = Cardano::where('created_at', '>=', Carbon::now()->sub($time, $timeValue))
                ->get();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error searching the given symbol, error : ' . $e], 400);
        }

        if ($crypto->isEmpty()) {
            return response()->json(['message' => 'No cardano found for the given time'], 404);
        }

        $data = [];

        foreach ($crypto as $c) {
            $cryptoArray = $c->toArray();
            $data[] = [
                'name' => $cryptoArray['name'] ?? null,
                'symbol' => $cryptoArray['symbol'] ?? null,
                'price' => $cryptoArray['price'] ?? null,
                'market_cap' => $cryptoArray['market_cap'] ?? null,
                'volume' => $cryptoArray['volume'] ?? null,
                'change_1h' => $cryptoArray['change_1h'] ?? null,
                'change_24h' => $cryptoArray['change_24h'] ?? null,
                'change_7d' => $cryptoArray['change_7d'] ?? null,
                'created_at' => Carbon::parse($cryptoArray['created_at'])->format('d/m/Y H:i') ?? null,
            ];
        }

        return response()->json($data);
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
