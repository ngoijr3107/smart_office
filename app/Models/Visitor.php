<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'lname','fname','email','phone','company','c_no','department_id',
        'purpose','status','checkintime','checkouttime', 'signature',
        'comment',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
