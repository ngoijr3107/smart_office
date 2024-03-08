<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LockerLog;
use App\Models\Attendance;
use App\Models\Visitor;
use Illuminate\Support\Facades\Response;
// use DB;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
        
        // Count of all visitors created today
        $visitors = Visitor::whereDate('created_at', $today)->count('id');

        // Count of checked-out visitors created today with status 'out'
        $checkedin = Visitor::where('status', 'in')->whereDate('created_at', $today)->count('id');
    
        // Count of checked-out visitors created today with status 'out'
        $checkedout = Visitor::where('status', 'out')->whereDate('updated_at', $today)->count('id');
    
        return view('Dashboard.index', compact('visitors', 'checkedout', 'checkedin'));
    }

    public function chart($startDate = null, $endDate = null)
    {
        $data = Visitor::join('departments', 'visitors.department_id', '=', 'departments.id')
            ->select(DB::raw('DATE(visitors.created_at) as date'), 'departments.name as department_name', DB::raw('count(visitors.id) as visits'))
            ->when($startDate, function ($query, $startDate) {
                return $query->where('visitors.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->where('visitors.created_at', '<=', $endDate);
            })
            ->groupBy('date', 'departments.name')
            ->get();
    
        return view('Dashboard.index', compact('data'));
    }
    

}
