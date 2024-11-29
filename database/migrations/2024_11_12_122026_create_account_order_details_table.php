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
        Schema::create('account_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamp('deliver')->nullable();
            $table->timestamp('arrive')->nullable();
            $table->timestamp('payment')->nullable();
            $table->timestamp('processing')->nullable();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_order_details');
    }
};
