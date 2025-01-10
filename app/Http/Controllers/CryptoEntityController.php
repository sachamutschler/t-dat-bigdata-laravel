<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CryptoEntity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CryptoEntityController extends Controller
{
    /**
     * Store Crypto in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $crypto = new CryptoEntity();
        $crypto->name = $request->name;
        $crypto->symbol = $request->symbol;
        $crypto->price = $request->price;
        $crypto->market_cap = $request->market_cap;
        $crypto->volume = $request->volume;
        $crypto->change_1h = $request->change_1h;
        $crypto->change_24h = $request->change_24h;
        $crypto->change_7d = $request->change_7d;
        $crypto->save();

        return response()->json($crypto, 201);
    }

    /**
     * Get Crypto data by symbol and by time (hour, day, week, month, year) from now.
     *
     * @param string $symbol
     * @param string $time
     * @param int|null $timeValue
     * @return JsonResponse
     */
    public function show(string $symbol, string $time, ?int $timeValue): JsonResponse
    {
        if (!in_array($time, ['hours', 'days', 'weeks', 'months', 'years'])) {
            return response()->json(['message' => 'Invalid time unit'], 400);
        }
        try {
            $crypto = CryptoEntity::where('symbol', Str::upper($symbol))
                ->where('created_at', '>=', Carbon::now()->sub($time, $timeValue))
                ->get();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error searching the given symbol, error : ' . $e], 400);
        }

        if ($crypto->isEmpty()) {
            return response()->json(['message' => 'No data found for the given symbol'], 404);
        }

        $data = [];

        foreach ($crypto as $c) {
            $cryptoArray = $c->toArray();
            $data[] = [
                'symbol' => $cryptoArray['symbol'] ?? null,
                'price' => $cryptoArray['price'] ?? null,
                'market_cap' => $cryptoArray['market_cap'] ?? null,
                'volume' => $cryptoArray['volume'] ?? null,
                'change_1h' => $cryptoArray['change_1h'] ?? null,
                'change_24h' => $cryptoArray['change_24h'] ?? null,
                'change_7d' => $cryptoArray['change_7d'] ?? null,
                'created_at' => $cryptoArray['created_at'] ?? null,
            ];
        }

        return response()->json($data);
    }
}
