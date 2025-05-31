<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // e.g., Payable, Receivable
            $table->decimal('amount', 12, 2);
            $table->date('due_date');
            $table->string('status'); // e.g., Pending, Paid, Overdue
            $table->text('description')->nullable();
            $table->foreignId('sale_id')->nullable()->constrained('sale')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financials');
    }
};
