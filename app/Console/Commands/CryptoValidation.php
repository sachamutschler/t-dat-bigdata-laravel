<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptoEntity;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CryptoValidation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crypto-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate the Bitcoin price against CoinGecko API';

    /**
     * Tolerance percentage for price difference.
     */
    protected float $tolerance = 5; // Tolérance de 5%

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $lastPrice = CryptoEntity::where('symbol', 'BTC')
            ->orderBy('created_at', 'desc')
            ->first();
        if (!$lastPrice) {
            $this->error('No record found in the database.');
            return;
        }

        $storedPrice = (float) $lastPrice->price;

        $response = Http::withHeaders([
            'x-cg-demo-api-key' => 'CG-pQFenoE7HkncLzj3HujZ48Kx',
        ])->accept('application/json')
            ->get('https://api.coingecko.com/api/v3/simple/price', [
                'ids' => 'bitcoin',
                'vs_currencies' => 'usd',
                'include_24hr_change' => 'true',
            ]);

        if ($response->failed() || !$response->json()) {
            $this->error('Failed to fetch data from CoinGecko API.');
            Log::error('CoinGecko API call failed.', ['response' => $response->body()]);
            return;
        }

        $apiPrice = (float) $response->json()['bitcoin']['usd'];

        // Calcul de la différence en pourcentage
        $difference = abs(($apiPrice - $storedPrice) / $storedPrice) * 100;

        if ($difference > $this->tolerance) {
            $message = sprintf(
                'Price discrepancy detected! Stored: $%s, API: $%s, Diff: %.2f%%',
                number_format($storedPrice, 2),
                number_format($apiPrice, 2),
                $difference
            );

            $this->warn($message);
            Log::warning($message);
        } else {
            $this->info('Price is within acceptable range.' . $difference . '%' . ' ' . $apiPrice . ' ' . $storedPrice);
        }
    }
}
