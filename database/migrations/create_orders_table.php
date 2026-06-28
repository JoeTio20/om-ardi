<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('whatsapp');
            $table->text('address');
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->bigInteger('total');
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->json('items');
            $table->string('midtrans_token')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
