<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visitor;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name'
    ];

    public function visitors(){
        return $this->hasMany(Visitor::class);
    }
}
