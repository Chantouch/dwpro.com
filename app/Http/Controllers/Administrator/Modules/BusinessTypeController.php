<?php

namespace App\Http\Controllers\Administrator\Modules;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_types = BusinessType::latest()->orderBy('created_at', 'desc')->get();
        return $business_types;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, BusinessType::rules(), BusinessType::messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please input the required field.');
        }
        $data['status'] = 1;
        $business_type = BusinessType::create($data);
        if (!$business_type) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'សូមអធ្យាស្រ័យ ពូកយើងមិនអាចធ្វើប្រតិបត្តិការរបស់លោកអ្នកបាន​ទេ។');
        }
        return $business_type;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        BusinessType::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BusinessType::find($id)->delete();
        return response()->json(['done']);
    }
}
