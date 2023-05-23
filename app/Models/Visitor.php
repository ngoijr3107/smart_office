<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'lname','fname','email','phone','company','c_no','department',
        'purpose','status','checkintime','checkouttime', 'signature',
    ];
}
