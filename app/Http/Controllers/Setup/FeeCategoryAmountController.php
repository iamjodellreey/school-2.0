<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\FeeCategoryAmount\AllFormRequest;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeCategoryAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $feeCategoryList = FeeCategoryAmount::whereHas('fee_category', function (Builder $query) {
        //     $query->groupBy('fee_category_id');
        // })->with('student_class')->get();

        $feeCategoryList = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();

        return view('school.setup.fee_category_amount.index', [
            'feeCategoryList' => $feeCategoryList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataList['fee_categories'] = FeeCategory::all();
        $dataList['classes'] = StudentClass::all();

        return view('school.setup.fee_category_amount.create', [
            'fee_categories' => $dataList['fee_categories'],
            'classes' => $dataList['classes'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countClass = count($request->class_id);

        if ($countClass != null) {
            for ($i = 0; $i < $countClass; $i++) {

                FeeCategoryAmount::create([
                    // FIXME: Apply form request validation
                    'fee_category_id' => $request['fee_category_id'],
                    'class_id' => $request['class_id'][$i],
                    'amount' => $request['amount'][$i],
                ]);
            }
        }

        return redirect()->route('setups.fee.category.amount.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($feeCategoryId)
    {
        // OPTIMIZE
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$feeCategoryId)->orderBy('class_id','asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

        return view('school.setup.fee_category_amount.edit', [
            'editData' => $data['editData'],
            'fee_categories' => $data['fee_categories'],
            'classes' => $data['classes'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $feeCategoryId)
    {
        // TODO: Add condition to check if there is no class
        $countClass = count($request->class_id);
        FeeCategoryAmount::where('fee_category_id',$feeCategoryId)->delete();
                for ($i = 0; $i < $countClass ; $i++) {
                    FeeCategoryAmount::create([
                        // FIXME: Apply form request validation
                        'fee_category_id' => $request['fee_category_id'],
                        'class_id' => $request['class_id'][$i],
                        'amount' => $request['amount'][$i],
                    ]);
                }

            return redirect()->route('setups.fee.category.amount.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($feeCategoryId)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$feeCategoryId)->orderBy('class_id','asc')->get();

        return view('school.setup.fee_category_amount.details', [
            'detailsData' => $data['detailsData'],
        ]);
    }

}
