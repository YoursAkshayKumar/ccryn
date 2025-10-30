<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->string('exam_name')->nullable();
            $table->string('result_status', 50)->nullable(); // Pass / Fail
            $table->string('total_marks', 20)->nullable();
            $table->string('obtained_marks', 20)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->string('grade', 10)->nullable();
            $table->text('remarks')->nullable();
            $table->string('result_file')->nullable(); // path to uploaded result file
            $table->timestamps();

            // Foreign key reference
            $table->foreign('applicant_id')
                ->references('id')->on('applicants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_results');
    }
};
