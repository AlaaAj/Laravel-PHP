<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('customer_name')->nullable()->nullable();
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('user_name');
            $table->integer('designer_id')->unsigned()->nullable();
            $table->integer('printWorker_id')->unsigned()->nullable();
             $table->text('customer_notes')->nullable();
            $table->float('discount');
            $table->float('tax');
            $table->float('total');
            $table->float('sub_total');
            $table->string('tax_type');
            $table->string('discount_type');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
