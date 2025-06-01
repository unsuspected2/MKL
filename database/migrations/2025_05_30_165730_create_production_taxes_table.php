<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('tax_type'); // e.g., VAT, Income Tax
            $table->decimal('amount', 12, 2);
            $table->date('due_date');
            $table->string('status'); // e.g., Pending, Paid
            $table->foreignId('sale_id')->nullable()->constrained('sale')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
