<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('record_id');

<<<<<<< HEAD
            // ត្រូវប្រាកដថា patients មាន patient_id ត្រឹមត្រូវ
            $table->foreignId('patient_id')
                ->constrained('patients', 'patient_id');

            // កែសម្រួលត្រង់នេះ ដើម្បីការពារ Error Foreign Key ជាមួយ users
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id') // ប្ដូរមក 'id' វិញ ប្រសិនបើតារាង users ប្រើ id ជា PK
                ->on('users')
                ->nullOnDelete();
=======
            // Foreign Key ភ្ជាប់ទៅ patients table (Primary Key: patient_id)
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('patient_id')
                  ->on('patients')
                  ->onDelete('cascade');

            // Foreign Key ភ្ជាប់ទៅ users table (Primary Key: id)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
>>>>>>> 50a841fed0665507ef91532f088778c6c8d1d66d

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

    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}