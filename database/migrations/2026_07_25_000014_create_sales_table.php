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

            $table->foreignId('patient_id')
                ->nullable()
                ->constrained('patients', 'patient_id')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->constrained('users', 'id');

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