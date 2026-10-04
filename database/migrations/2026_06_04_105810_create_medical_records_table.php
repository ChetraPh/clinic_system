<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('record_id');

            $table->foreignId('patient_id')
                ->constrained('patients', 'patient_id');
                
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id') 
                ->nullOnDelete();

            $table->dateTime('visit_date');

            $table->string('diagnosis', 255)->nullable();
            $table->string('notes', 255)->nullable();

            $table->decimal('bp_systolic', 8, 2)->nullable();
            $table->decimal('bp_diastolic', 8, 2)->nullable();

            $table->integer('heart_rate')->nullable();
            $table->integer('respiratory_rate')->nullable();

            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('spo2', 5, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();

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
        Schema::dropIfExists('medical_records');
    }
}