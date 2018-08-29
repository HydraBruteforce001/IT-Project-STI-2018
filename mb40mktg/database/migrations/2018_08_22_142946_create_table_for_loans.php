<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateTableForLoans extends Migration
{
    protected $tableName = 'tbl_loans';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                // primary key
                $table->increments('id');
                //account_id of the client
                $table->integer('account_id');
                //length of amortization
                $table->integer('length'); // 30, 90, 180
                //loan value of current loan record
                $table->integer('loan_value');
                //daily amortization value - this is calculated upon entry and approval
                $table->integer('amortization');
                //interest rate if there are
                $table->integer('interest_rt')->default('0');
                //if this loan is active OR inactive on client's account
                $table->boolean('status');//active / inactive
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}