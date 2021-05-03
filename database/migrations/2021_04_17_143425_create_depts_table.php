<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deptor_id');
            $table->decimal('original_dept', 18, 2);
            $table->decimal('interest', 18, 2)->nullable();
            $table->date('dept_until')->nullable();
            $table->text('note')->nullable();
            $table->decimal('total_dept', 18, 2);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('deptor_id')->references('id')->on('deptors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depts');
    }
}
