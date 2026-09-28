<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');

<<<<<<< HEAD
            // ត្រូវប្រាកដថា patients មាន patient_id ជា BigIncrements ឬ BigInteger Unsigned
            $table->foreignId('patient_id')
                ->constrained('patients', 'patient_id')
                ->onDelete('cascade');

            // កែតម្រូវត្រង់នេះ៖ ប្រសិនបើតារាង users ប្រើ id ជា PK ធម្មតា
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // ប្រសិនបើក្នុងតារាង users របស់អ្នក ប្រើប្រាស់ field ឈ្មោះ 'user_id' ពិតប្រាកដជា Primary Key 
            // អ្នកអាចប្រើកូដខាងក្រោមនេះជំនួសវិញ៖
            /*
            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->onDelete('cascade');
            */
=======
            // Foreign Key ភ្ជាប់ទៅ patients table (Primary Key: patient_id)
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('patient_id')
                  ->on('patients')
                  ->onDelete('cascade');

            // Foreign Key ភ្ជាប់ទៅ users table (Primary Key: id)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
>>>>>>> 50a841fed0665507ef91532f088778c6c8d1d66d

            $table->dateTime('appointment_date');

            $table->enum('status', [
                'scheduled',
                'completed',
                'cancelled'
            ])->default('scheduled');

            $table->string('reason', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}