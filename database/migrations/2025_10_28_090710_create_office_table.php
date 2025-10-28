<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('office', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('office_name');
            $table->text('office_address')->nullable();
            $table->string('office_code')->unique();

            $table->uuid('region_id');
            $table->uuid('office_type_id');

            $table->string('office_phone')->nullable();
            $table->string('office_email')->nullable();
            $table->string('office_head')->nullable(); // nama kepala kantor
            $table->boolean('office_status')->default(true);

            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('office_type_id')->references('id')->on('office_types')->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('office');
    }
};
