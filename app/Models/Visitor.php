<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\VisitPurpose;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'lname','fname','email','phone','company','c_no','department_id',
        'purpose_id','status','checkintime','checkouttime', 'signature', 'rate',
        'comment',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function purpose() {
        return $this->belongsTo(VisitPurpose::class);
    }
}
