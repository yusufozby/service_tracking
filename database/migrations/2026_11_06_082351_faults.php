
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->id();

            // İlişkiler
            $table->foreignId('device_id')
                ->constrained('devices')
                ->cascadeOnDelete();

            $table->foreignId('reported_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Arıza bilgileri
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('fault_date');

            // Öncelik ve durum
            $table->enum('priority', [
                'low',
                'medium',
                'high',
                'critical'
            ])->default('medium');

            $table->enum('status', [
                'pending',
                'in_progress',
                'resolved',
                'cancelled'
            ])->default('pending');

            // Teknik işlem bilgileri
            $table->text('diagnosis')->nullable();
            $table->text('solution')->nullable();

            // Çözülme tarihi
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faults');
    }
};
