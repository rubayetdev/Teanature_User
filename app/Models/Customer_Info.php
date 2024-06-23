<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Info extends Model
{
    use HasFactory;

    protected $fillable =[
        'id','name','email','phone','address','distric', 'image'
    ];
}
