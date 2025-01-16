<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoEntity extends Model
{
    public string $name;
    public string $symbol;
    public float $price;
    public float $market_cap;
    public float $volume;
    public float $change_1h;
    public float $change_24h;
    public float $change_7d;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crypto_entities';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'symbol',
        'price',
        'market_cap',
        'volume',
        'change_1h',
        'change_24h',
        'change_7d',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
