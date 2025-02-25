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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('precipitation_threshold', 5, 2)->default(10.0);
            $table->integer('uv_index_threshold')->default(5);
            $table->boolean('notify_email')->default(true);
            $table->boolean('notify_sms')->default(false);
            $table->string('phone_number')->nullable();
            $table->timestamp('paused_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
