<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('repairs', function (Blueprint $table) {
    $table->id();
    $table->string('equipment_code'); 
    $table->string('equipment_name'); 
    $table->text('problem_detail'); 
    $table->enum('urgency', ['normal', 'medium', 'high', 'urgent'])->default('normal'); 
    $table->string('reporter_name'); 
    $table->string('image_path')->nullable(); 
    $table->enum('status', ['pending', 'in_progress', 'success', 'rejected'])->default('pending'); 
    $table->text('repair_details')->nullable(); 
    $table->decimal('price', 10, 2)->default(0); // ค่าใช้จ่าย
    $table->string('slip_path')->nullable(); // รูปสลิปโอนเงิน
    $table->enum('payment_status', ['unpaid', 'pending_approval', 'paid'])->default('unpaid'); // สถานะการจ่ายเงิน
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};