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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->enum('type', [
                'text', 'number', 'date', 'email', 'textarea', 'select', 'radio', 'checkbox',
            ]);
            $table->text('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->text('validation_rules')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->unsignedBigInteger('formable_id');
            $table->enum('formable_type', ['section', 'subsection']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
