<?php

namespace App\Http\Controllers\SmartOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use DB;
use Session;

class VisitorController extends Controller
{
    public function listVisitors(){
        $visitors = Visitor::latest()->get();

        return view('VisitorManagement.index')->with('visitors', $visitors);
    }

    public function editVisitor($id){
        $visitor = Visitor::findOrFail($id);
        
    }

    public function deleteVisitor($id)
    {
        $delete = DB::table('visitors')->where('id', $id)->delete();

        Session::flash('success', 'Visitor has been successfully deleted.');
        return redirect()->route('visitor');
    }
}
