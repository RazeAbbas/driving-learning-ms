<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('org')->nullable();
            $table->string('email')->nullable();
            $table->string('code');
            $table->string('type');
            $table->string('price_type')->nullable();
            $table->string('price');
            $table->integer('used')->default(0)->comment('Number of times the coupon has been used');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('coupons');
    }
}
