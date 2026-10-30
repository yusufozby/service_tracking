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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('device_id')->constrained('devices');
            $table->enum('status',['pending','continues','ready','delivered']);
            $table->string('service_no');
            $table->string('fault');
            $table->foreignId('personel_id')->constrained('personels');
            $table->date('date_of_entry');
          $table->decimal('price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
