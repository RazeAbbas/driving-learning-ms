<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = [];
    
    public static function getPaymentGatewayCredentials($gateway)
    {
        return static::where('key', $gateway . '_key')->orWhere('key', $gateway . '_secret')->pluck('value', 'key');
    }
}
