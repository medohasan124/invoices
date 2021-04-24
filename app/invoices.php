<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
     protected $fillable = [
        'invoice_number', 'invoice_date', 'due_date', 'product' , 'section' , 'vat'  , 'rate_vat' , 'my_vat' ,'status' , 'total' , 'note' , 'addBy' ,
    ];



   
}
