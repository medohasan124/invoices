<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');
            $table->date('invoice_date');
            $table->string('product');
            $table->string('section');
            $table->decimal('vat');
            $table->decimal('rate_vat');
            $table->decimal('my_vat');
            $table->decimal('total');
            $table->integer('status');
            $table->date('payment_date')->nullable();
            $table->string('addBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
