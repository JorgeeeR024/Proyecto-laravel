<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('id_evaluation'); // BIGINT UNSIGNED
            $table->unsignedBigInteger('subject_id'); // debe coincidir con subjects.id_subject
            $table->unsignedBigInteger('grade_id');   // debe coincidir con grades.id_grade
            $table->enum('type',['quiz','exam','assignment','project']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('total_score',5,2);
            $table->date('date');
            $table->timestamps();

            // Foreign keys
            $table->foreign('subject_id')->references('id_subject')->on('subjects')->onDelete('cascade');
            $table->foreign('grade_id')->references('id_grade')->on('grades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
