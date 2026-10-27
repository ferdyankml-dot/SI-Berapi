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
        Schema::create('disaster_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volcano_id')->constrained('volcanoes')->cascadeOnDelete();
            $table->date('event_date');
            $table->text('description');
            $table->text('impact_summary');
            $table->integer('casualties_count')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster_histories');
    }
};
