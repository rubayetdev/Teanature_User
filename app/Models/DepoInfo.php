<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepoInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'owner_name',
        'trade_lic',
        'nid_front',
        'nid_back',
        'address',
        'city',
        'mobile',
        'pic',
        'action',
    ];
}
