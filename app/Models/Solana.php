<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solana extends Model
{
    public string $name;
    public string $symbol;
    public float $price;
    public float $market_cap;
    public float $volume;
    public string $change_1h;
    public string $change_24h;
    public string $change_7d;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solanas';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
