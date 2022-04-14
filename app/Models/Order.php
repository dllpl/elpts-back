<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'type_owner',

        'last_name',
        'first_name',
        'patronymic',
        'city',
        'street',
        'home',
        'flat',

        'org_name',
        'kpp',
        'ogrn',

        'pass_serial',
        'pass_number',

        'inn',
        'snils',

        'phone',
        'email',

        'car_mark',
        'commercial_name',
        'car_type',
        'car_id',
        'car_color',
        'drive_ts',
        'engine_model',
        'engine_number',
        'odometr',
        'engine_power',
        'engine_volume',
        'fuel',

        'sts_front',
        'sts_back',
        'ts_front',
        'ts_back',
        'ts_right',
        'ts_left',
        'vin_door',
        'vin_glass',

        'price',
        'pay_method',
        'pay_success',
    ];

    public function image()
    {
        return $this->hasOne(Image::class);
    }


}
