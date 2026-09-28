<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');

            // Nullable: allow walk-in / non-patient sales at the pharmacy counter
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')
                  ->references('patient_id')
                  ->on('patients')
                  ->onDelete('set null');

<<<<<<< HEAD
            // កែសម្រួលត្រង់នេះ៖ ប្រើ unsignedBigInteger និង references 'id' របស់តារាង users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
=======
            // Foreign Key ភ្ជាប់ទៅ users table (Primary Key: id)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
>>>>>>> 50a841fed0665507ef91532f088778c6c8d1d66d

            $table->dateTime('sale_date');
            $table->decimal('total_amount', 12, 2)->unsigned()->default(0);
            $table->enum('status', ['COMPLETED', 'VOID'])->default('COMPLETED');

            $table->timestamps();

            $table->index('sale_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}