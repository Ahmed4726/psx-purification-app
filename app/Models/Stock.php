<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticker',
        'company_name',
        'objective',
        'debt_ratio',
        'investment_ratio',
        'income_ratio',
        'illiquid_assets_ratio',
        'net_liquid_assets_ratio',
        'share_price',
        'final_shariah_status',
    ];
}
