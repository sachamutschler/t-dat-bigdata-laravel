<?php

namespace App\Http\Controllers;

use App\Models\Ethereum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    /**
     * Get Ethereum data by time (hour, day, week, month, year) from now.
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
            $crypto = Ethereum::where('created_at', '>=', Carbon::now()->sub($time, $timeValue))
                ->get();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error searching the given date, error : ' . $e], 400);
        }

        if ($crypto->isEmpty()) {
            return response()->json(['message' => 'No ethereum found for the given time'], 404);
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
