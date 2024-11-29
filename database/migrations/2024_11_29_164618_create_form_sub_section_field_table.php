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
        Schema::create('form_sub_section_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_sub_section_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('form_field_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_sub_section_field');
    }
};
