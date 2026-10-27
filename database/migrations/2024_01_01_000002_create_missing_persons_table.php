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
        Schema::create('missing_persons', function (Blueprint $table) {
            $table->id();
            $table->string('reporter_name');
            $table->string('reporter_phone');
            $table->string('victim_name');
            $table->integer('age');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('photo')->nullable();
            $table->text('characteristics');
            $table->foreignId('volcano_id')->nullable()->constrained('volcanoes')->nullOnDelete();
            $table->string('last_seen_location');
            $table->date('last_seen_date');
            $table->enum('status', ['Dicari', 'Ditemukan'])->default('Dicari');
            $table->text('notes')->nullable();
            $table->boolean('is_approved')->default(true); // Default true for user convenience/demo, editable by admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_persons');
    }
};
