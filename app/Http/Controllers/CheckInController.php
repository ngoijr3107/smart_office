<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Department;
use App\Models\VisitPurpose;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class CheckInController extends Controller
{
    public function checkIn()
    {
        // Alert::success('Success Title');
        $departments = Department::all();
        return view('CheckIn.check_in', compact(['departments']));
    }

    public function checkInFinal(Request $request)
    {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $company = $request->input('company');
        $c_no = $request->input('c_no');

        // Store the input data in the session
        $request->session()->put('fname', $fname);
        $request->session()->put('lname', $lname);
        $request->session()->put('phone', $phone);
        $request->session()->put('email', $email);
        $request->session()->put('company', $company);
        $request->session()->put('c_no', $c_no);

        // Redirect the user to next page
        $departments = Department::get();
        $purposes = VisitPurpose::get();
        return view('CheckIn.check_in_two', compact('departments', 'purposes', 'fname', 'lname', 'phone', 'company', 'c_no', 'email'));
    }

    public function saveCheckIn(Request $request)
    {

        // Retrieve the input data from the session
        $fname = $request->session()->get('fname');
        $lname = $request->session()->get('lname');
        $email = $request->session()->get('email');
        $phone = $request->session()->get('phone');
        $company = $request->session()->get('company');
        $c_no = $request->session()->get('c_no');
        $department_id = $request->input('department_id');
        $purpose_id = $request->input('purpose_id');
        $status = 'in';
        $checkintime = $request->input('checkintime');
        // $signature = $request->input('signature');

        // Save the input data to the database
        try {
            $check_in = new Visitor;
            $check_in->fname = $fname;
            $check_in->lname = $lname;
            $check_in->email = $email;
            $check_in->phone = $phone;
            $check_in->company = $company;
            $check_in->c_no = $c_no;
            $check_in->department_id = $department_id;
            $check_in->purpose_id = $purpose_id;
            $check_in->status = $status;
            $check_in->checkintime = $checkintime;
            // $signature->signature = $signature;
            $check_in->save();

            Alert::success('Success', 'Checked-in successfully!');
            return redirect()->route('home');
        } catch (\Exception $e) {
            Alert::error('Error Title', 'Error Message');
            return redirect()->route('home');
        }
    }

    public function checkOut(Request $request)
    {
        if ($request->ajax()) {
            $visitors = Visitor::select('id', 'fname', 'lname', 'checkintime')->where('status', 'in')->get();

            return Datatables::of($visitors)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('checkOutItem', ['id' => $row->id]) . '" class="btn btn-primary btn-sm">Check-out</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('CheckIn.check_out');
    }


    public function checkOutItem($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('CheckIn.checkout_confirm', compact('visitor'));
    }

    public function checkOutConfirm(Request $request, $id)
    {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $company = $request->input('company');
        $c_no = $request->input('c_no');
        $department = $request->input('department');
        $purpose = $request->input('purpose');
        $status = 'out';
        $checkintime = $request->input('checkintime');
        $checkouttime = $request->input('checkouttime');
        $comment = $request->input('comment');
        $rate = $request->input('rate');

        // Update database values
        try {
            $check_in = Visitor::find($id);
            $check_in->status = $status;
            $check_in->checkouttime = $checkouttime;
            $check_in->comment = $comment;
            $check_in->rate = $rate;
            $check_in->update();

            Alert::success('Success', 'Checked-out successfully!');
            return redirect()->route('home');
        } catch (\Exception $e) {
            Alert::error('Error Title', 'Error Message');
            return redirect()->route('home');
        }
    }
}
