<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('division_name');
            $table->string('division_code', 50)->unique();
            $table->text('division_description')->nullable();
            $table->uuid('office_id');
            $table->string('division_head')->nullable();
            $table->boolean('division_status')->default(true);
            $table->timestamps();

            $table->foreign('office_id')
                  ->references('id')
                  ->on('office')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
