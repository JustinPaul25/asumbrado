<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->date('date_applied');
            $table->string('name');
            $table->longText('address');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employers_name')->nullable();
            $table->string('civil_status');
            $table->string('spouse')->nullable();
            $table->string('reference_one_name')->nullable();
            $table->string('reference_one_address')->nullable();
            $table->string('reference_one_mobile_no')->nullable();
            $table->string('reference_one_relationship')->nullable();
            $table->string('reference_two_name')->nullable();
            $table->string('reference_two_address')->nullable();
            $table->string('reference_two_mobile_no')->nullable();
            $table->string('reference_two_relationship')->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
