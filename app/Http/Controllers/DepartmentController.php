<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\Department;
use DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class DepartmentController extends Controller
{
    public function index()
    {
        $datas = Department::latest()->get();
        return view('Department.index')->with('datas', $datas);
    }
    

    public function add()
    {
        return view('Department.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'department_name' => 'required|min:3|max:50',
        ];

        $messages = [
            'department_name.required' => 'Department name is required.',
            'department_name.min' => 'Department name must be at least 3 characters.',
            'department_name.max' => 'Department name must not exceed 50 characters.',
            'department_name.unique' => 'Department name already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $department = new Department;
        $department->department_name = ucwords(strtolower($request->department_name));
        $save = $department->save();

        if ($save) {
            Session::flash('success', 'Successfully added a new department.');
            return redirect()->route('department');
        } else {
            Session::flash('error', 'Failed to add a new department. Please try again later.');
            return redirect()->route('department');
        }
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('Department.edit', compact('department'));
    }

    public function update(Request $request, $id)
{
    $department = Department::find($id);

    if (!$department) {
        Session::flash('error', 'Department not found.');
        return redirect()->route('department');
    }

    $department->department_name = ucwords(strtolower($request->department_name));

    $save = $department->save();

    if ($save) {
        Session::flash('success', 'Department has been successfully updated.');
        return redirect()->route('department');
    } else {
        Session::flash('error', 'Failed to update the department. Please try again later.');
        return redirect()->route('department');
    }
}


    public function delete($id)
    {
        $delete = DB::table('departments')->where('id', $id)->delete();

        Session::flash('success', 'Department has been successfully deleted.');
        return redirect()->route('department');
    }
}
