<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sections ;
class section extends Controller
{

    function __construct()
{

$this->middleware('permission:section-list', ['only' => ['index','store']]);
$this->middleware('permission:section-create', ['only' => ['create','store']]);
$this->middleware('permission:section-edit', ['only' => ['edit','update']]);
$this->middleware('permission:section-delete', ['only' => ['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('admin.sections') ;
        $data  = sections::all(); 
        return view('admin.invoice.section' , compact('title' , 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'yes' ;
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
            'name' => 'required|unique:sections' ,  
            'description' => 'sometimes|nullable' ,  
        ]  ,[
            'name.required' => trans('admin.required_section'), 
            'name.unique' => trans('admin.unique_section'), 
            
          
        ]);

       $data['addBy'] = \Auth::user()->name ;

       sections::create($data) ;

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
            'name' => 'required|unique:sections,id,'.$request['id'] ,  
            'description' => 'sometimes|nullable' ,  
        ]  ,[
            'name.required' => trans('admin.required_section'), 
            'name.unique' => trans('admin.unique_section'), 
            //'name.unique' => 'this Name must Be unique', 
          
        ]);

       $data['addBy'] = \Auth::user()->name ;

       sections::where('id' ,$id)->update($data) ;

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
           sections::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }else{
             $id = request('id') ;
           sections::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }
    
    }
}
