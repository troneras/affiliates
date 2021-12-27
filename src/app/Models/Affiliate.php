<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\Geolocalizable;

class Affiliate extends Model
{
    use HasFactory;
    use Geolocalizable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'distance' => 'decimal:1'
    ];

    public function geolocalizable(): array
    {
        return [
            'latitude_field_name' => 'latitude',
            'longitude_field_name' => 'longitude',
        ];
    }
}
