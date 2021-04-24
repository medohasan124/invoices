<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sections ;
use App\products ;
class product extends Controller
{


        function __construct()
{

$this->middleware('permission:product-list', ['only' => ['index','store']]);
$this->middleware('permission:product-create', ['only' => ['create','store']]);
$this->middleware('permission:product-edit', ['only' => ['edit','update']]);
$this->middleware('permission:product-delete', ['only' => ['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('admin.products') ;
        $data  = products::all(); 

        /*forign key section*/
        $sections = sections::all() ;

    return view('admin.invoice.products' , compact('title' , 'data' , 'sections'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data =  $this->validate($request , [
            'name' => 'required' ,  
            'section_id' => 'required' ,  
           
        ]  ,[
            'name.required' => trans('admin.required_product'), 
            'section_id.required' => trans('admin.required_section'), 
            
            
          
        ]);

       $data['addBy'] = \Auth::user()->name ;

       products::create($data) ;

        session()->flash('success' , trans('admin.successToAdd'));
           return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data =  $this->validate($request , [
            'name' => 'required' ,  
            'section_id' => 'required' ,  
           
        ]  ,[
            'name.required' => trans('admin.required_product'), 
            'section_id.required' => trans('admin.required_section'), 
            
            
          
        ]);

       $data['addBy'] = \Auth::user()->name ;

      products::where('id' ,$id)->update($data) ;

        session()->flash('success' , trans('admin.succsess_update'));
           return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $q)
    {
         if(is_array(request('del')) ){
            $id = request('del') ;
           products::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }else{
             $id = request('id') ;
           products::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }
    }
}
