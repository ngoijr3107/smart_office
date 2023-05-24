<?php

namespace App\Http\Controllers\SmartOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function listVisitors(){
        $visitors = Visitor::latest()->paginate(5);

        return view('VisitorManagement.index')->with('visitors', $visitors);
    }
}
