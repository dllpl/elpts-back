<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'sts_front',
        'sts_back',
        'ts_front',
        'ts_back',
        'ts_right',
        'ts_left',
        'vin_door',
        'vin_glass',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
