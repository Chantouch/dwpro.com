<?php

namespace App\Http\Controllers\Administrator\Modules;

use App\Models\Industry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class IndustryController extends Controller
{

    private $industry;

    /**
     * IndustryController constructor.
     * @param Industry $industry
     */
    public function __construct(Industry $industry)
    {
        $this->industry = $industry;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Industry list";
        return view('administrator.modules.industry.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.modules.business-type.create');
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $data['status'] = 1;
        $industry = Industry::create($data);
        if (!$industry) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'We unable to process your request right now.');
        }
        return redirect()->route('admin.modules.business-types.index')->with('success', 'You data was saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('administrator.modules.business-type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('administrator.modules.business-type.edit');
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
        Industry::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Industry::find($id)->delete();
        return response()->json(['done']);
    }
}
