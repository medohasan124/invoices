<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
       protected $fillable = [
        'invoice_number', 'invoice_date' , 'product', 'section', 'vat', 'rate_vat' , 'my_vat' , 'total' , 'status'  , 'payment_date' ,'addBy'
    ];
}
