<?php

use Illuminate\Database\Seeder;
use App\invoices ;
class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('invoices')->delete();
        invoices::create([
        	'invoice_number' 	=> '123345456' ,
        	'invoice_date' 	 	=> '2021-03-17 00:50:57' ,
        	'due_date' 			=> '2021-03-17 00:50:57' ,
        	'product' 			=> '1' ,
        	'section' 			=> '1' ,
        	'vat' 				=> '100' ,
        	'rate_vat' 			=> '20' ,
        	'my_vat' 			=> '10' ,
        	'total' 			=> '200' ,
        	'status' 			=> '1' ,
        	'addBy' 			=> 'medo' ,
        ]);

        invoices::create([
        	'invoice_number' 	=> '45623490' ,
        	'invoice_date' 	 	=> '2021-03-17 00:50:57' ,
        	'due_date' 			=> '2021-03-17 00:50:57' ,
        	'product' 			=> '1' ,
        	'section' 			=> '1' ,
        	'vat' 				=> '100' ,
        	'rate_vat' 			=> '20' ,
        	'my_vat' 			=> '10' ,
        	'total' 			=> '200' ,
        	'status' 			=> '1' ,
        	'addBy' 			=> 'medo' ,
        ]);

        invoices::create([
        	'invoice_number' 	=> '45623490' ,
        	'invoice_date' 	 	=> '2021-03-17 00:50:57' ,
        	'due_date' 			=> '2021-03-17 00:50:57' ,
        	'product' 			=> '1' ,
        	'section' 			=> '1' ,
        	'vat' 				=> '100' ,
        	'rate_vat' 			=> '20' ,
        	'my_vat' 			=> '10' ,
        	'total' 			=> '200' ,
        	'status' 			=> '2' ,
        	'addBy' 			=> 'medo' ,
        ]);
    }
}
