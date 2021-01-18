<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('status')->nullable();
            $table->string('name');
            $table->string('area');
            $table->string('block_no');
            $table->string('lot_no');
            $table->float('total_price', 10, 2);
            $table->float('reservation_fee', 10, 2)->nullable();
            $table->float('monthly_payment', 10, 2)->nullable();
            $table->float('balance', 10, 2)->default(0);

            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
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
        Schema::dropIfExists('lots');
    }
}
