<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id('id_result');
            $table->unsignedBigInteger('evaluation_id'); // BIGINT UNSIGNED
            $table->unsignedBigInteger('student_id');    // BIGINT UNSIGNED, coincide con users.id_user
            $table->decimal('score',5,2)->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('evaluation_id')->references('id_evaluation')->on('evaluations')->onDelete('cascade');
            $table->foreign('student_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_results');
    }
};
