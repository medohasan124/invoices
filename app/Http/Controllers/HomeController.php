<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices ;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $title = trans('admin.dashboard');
        $data = invoices::all();
        return view('admin.index' , compact('title' ,'data'));

       


        
       

       


    }
}
