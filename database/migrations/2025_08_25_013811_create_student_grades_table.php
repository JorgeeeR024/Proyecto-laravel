<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id(); // PK autoincremental
            $table->unsignedBigInteger('user_id');   // estudiante
            $table->unsignedBigInteger('grade_id');  // grado
            $table->string('subject', 100);
            $table->decimal('period1', 5, 2)->nullable();
            $table->decimal('period2', 5, 2)->nullable();
            $table->decimal('period3', 5, 2)->nullable();
            $table->decimal('period4', 5, 2)->nullable();
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('grade_id')->references('id_grade')->on('grades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
