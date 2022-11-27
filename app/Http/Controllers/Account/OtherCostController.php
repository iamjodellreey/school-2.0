<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccountOtherCost;

class OtherCostController extends Controller
{
    public function index()
    {
        $data['allData'] = AccountOtherCost::orderBy('id','desc')->get();
        return view('school.account.other_cost.index', [
            'allData' => $data['allData'],
        ]);
    }

    public function create()
    {
        return view('school.account.other_cost.create');
    }

    public function store(Request $request)
    {
        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();

        // $notification = array(
        //     'message' => 'Other Cost Inserted Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('accounts.other.cost.index');

    }

    public function edit($id)
    {
        $data['editData'] = AccountOtherCost::find($id);

        return view('school.account.other_cost.edit', [
            'editData' => $data['editData'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $cost = AccountOtherCost::find($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'. $cost->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $cost['image'] = $filename;
        }

        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('accounts.other.cost.index');
    }
}
