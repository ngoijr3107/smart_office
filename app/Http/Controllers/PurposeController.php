<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\VisitPurpose;
use DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class PurposeController extends Controller
{
    public function index()
    {
        $datas = VisitPurpose::latest()->get();
        return view('Purpose.index', compact('datas'));
    }

    public function addPurpose()
    {
        return view('Purpose._add');
    }

    public function storePurpose(Request $request)
    {
        $rules = [
            'purpose_name' => 'required|min:3|max:50',
        ];

        $messages = [
            'purpose_name.required' => 'Purpose name is required.',
            'purpose_name.min' => 'Purpose name must be at least 3 characters.',
            'purpose_name.max' => 'Purpose name must not exceed 50 characters.',
            'purpose_name.unique' => 'Purpose name already exists.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $purpose = new VisitPurpose;
        $purpose->purpose_name = ucwords(strtolower($request->purpose_name));
        $save = $purpose->save();

        if ($save) {
            Session::flash('success', 'Successfully added a new purpose.');
            return redirect()->route('purpose');
        } else {
            Session::flash('error', 'Failed to add a new purpose. Please try again later.');
            return redirect()->route('purpose');
        }
    }

    public function editPurpose($id)
    {
        $purpose = VisitPurpose::find($id);
        return view('Purpose._edit', compact('purpose'));
    }

    public function updatePurpose(Request $request, $id)
{
    $purpose = VisitPurpose::find($id);

    if (!$purpose) {
        Session::flash('error', 'Purpose not found.');
        return redirect()->route('purpose');
    }

    $purpose->purpose_name = ucwords(strtolower($request->purpose_name));

    $save = $purpose->save();

    if ($save) {
        Session::flash('success', 'Purpose has been successfully updated.');
        return redirect()->route('purpose');
    } else {
        Session::flash('error', 'Failed to update the purpose. Please try again later.');
        return redirect()->route('purpose');
    }
}


    public function deletePurpose($id)
    {
        $delete = DB::table('visit_purposes')->where('id', $id)->delete();

        Session::flash('success', 'Purpose Category has been successfully deleted.');
        return redirect()->route('purpose');
    }
}
