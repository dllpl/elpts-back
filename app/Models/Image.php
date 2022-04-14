<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'pass_photo',
        'snils_photo',
        'sts_front',
        'sts_back',
        'pts_front',
        'pts_back',
        'ts_front',
        'ts_back',
        'ts_right',
        'ts_left',
        'vin_door',
        'vin_glass',
        'tire',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
