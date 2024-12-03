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
        Schema::create('form_sub_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_section_id')
                ->cascadeOnDelete()
                ->constrained();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_sub_sections');
    }
};
