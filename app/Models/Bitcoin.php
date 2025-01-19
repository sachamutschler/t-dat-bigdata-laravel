<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitcoin extends Model
{
    public string $name;
    public string $symbol;
    public float $price;
    public float $market_cap;
    public float $volume;
    public string $change_1h;
    public string $change_24h;
    public string $change_7d;
    public string $created_at;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bitcoins';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
