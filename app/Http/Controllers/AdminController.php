<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin-home');
    }

    public function getBusinessType()
    {
        return view('administrator.modules.business-type');
    }

    public function getCityProvince()
    {
        return view('administrator.modules.city-province');
    }

    public function getDepartment()
    {
        return view('administrator.modules.department.index');
    }
}
