<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices ;
use App\payments ;
use App\sections ;
use App\products ;
use App\User ;


class invoice extends Controller
{


    function __construct()
{

$this->middleware('permission:invoice-list', ['only' => ['index','store']]);
$this->middleware('permission:invoice-create', ['only' => ['create','store']]);
$this->middleware('permission:invoice-edit', ['only' => ['edit','update']]);
$this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $q)
    {

        if(request('status') == 1){
            
            $title = trans('admin.invice');
            $data = invoices::where('status' , 1)->get();
            return view('admin.invoice.status' , compact('data' ,'title')) ;
           
        }

         if(request('status') == 2){
            
            $title = trans('admin.invice');
            $data = invoices::where('status' ,2)->get();
            return view('admin.invoice.status' , compact('data' ,'title')) ;
        }
            $title = trans('admin.invice');
            $data = invoices::all();
            return view('admin.invoice.index' , compact('data' ,'title')) ;
        
        

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title   = trans('admin.create_invoice');
        $section = sections::all();
        $product = products::all();
       
        return view('admin.invoice.create' , compact('section' , 'product' ,'title')) ;
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
            'invoice_number'    => 'required|unique:invoices' ,  
            'invoice_date'      => 'required' ,  
            'due_date'          => 'required' ,  
            'section'           => 'required' ,  
            'product'           => 'required' ,  
            'vat'               => 'required' ,  
            'rate_vat'          => 'required' ,  
            //'my_vat'            => 'required' ,  
            //'total'             => 'required' ,  
            //'note'              => 'required' ,  
           
        ]  ,[
            'invoice_number.required'   => trans('admin.required_invoice_number'), 
            'invoice_date.required'     => trans('admin.required_invoice_date'), 
            'due_date.required'         => trans('admin.required_due_date'), 
            'product.required'          => trans('admin.required_product'), 
            'section.required'          => trans('admin.required_section'), 
            'vat.required'              => trans('admin.required_vat'), 
            'rate_vat.required'         => trans('admin.required_rate_vat'), 
          
        ]);

         $data['my_vat']    = $data['vat'] * $data['rate_vat'] / 100 ;
         $data['total']     = $data['vat'] - $data['my_vat'] ;
         $data['note']      = $request['note'] ;
         $data['addBy']     = \Auth::user()->name ;
         $data['status']     = 1 ;
         invoices::create($data) ;

          $payment['invoice_number']    = $data['invoice_number'] ;
          $payment['invoice_date']      = $data['invoice_date'] ;
          $payment['due_date']          = $data['due_date'] ;
          $payment['section']           = $data['section'] ;
          $payment['product']           = $data['product'] ;
          $payment['vat']               = $data['vat'] ;
          $payment['rate_vat']          = $data['rate_vat'] ;
          $payment['my_vat']            = $data['my_vat'] ;
          $payment['total']             = $data['total'] ;
        //  $payment['payment_date']    = $data['payment_date'] ;
          $payment['status']            = 1 ;
           $payment['addBy']            = \Auth::user()->name ;
         payments::create($payment) ;


    $user = User::find(1);
    $details = [
            'name' => \Auth::user()->name ,
            'id' => invoices::where('invoice_number' , $data['invoice_number'])->first()->id ,
            'body' => 'invoices add by',
   
    ];
    $user->notify(new \App\Notifications\invoice($details));


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
        $title = trans('admin.print');
        $data = invoices::where('id' , $id)->first();
       
       return view('admin.invoice.print' , compact('data' ,'title')) ;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // invoices::where('id');
       
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
        $data = invoices::find($id);
        $data->status = $request['status'] ;
        $data->save();

         $data = payments::find($id);
        $data->status = $request['status'] ;
        $data->save();
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
           invoices::destroy($id);
            products::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }else{
             $id = request('id') ;
           invoices::destroy($id);
           products::destroy($id);
           session()->flash('success' , trans('admin.succsess_delete'));
           return back();
        }
    }

}
