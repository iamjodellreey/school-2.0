<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\FeeCategory\AllFormRequest;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeCategoryList = FeeCategory::all();
        return view('school.setup.fee_category.index', [
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
        return view('school.setup.fee_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AllFormRequest $request)
    {
        $data = $request->validated();

        FeeCategory::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.fee.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeCategory $feeCategory)
    {
        return view('school.setup.fee_category.edit', [
            'feeCategory' => $feeCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, FeeCategory $feeCategory)
    {
        $data = $request->validated();

        $feeCategory->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.fee.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeCategory $feeCategory)
    {
        $feeCategory->delete();
        return redirect()->route('setups.fee.category.index');
    }
}
