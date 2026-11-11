<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('midtrans_transaction_id')->nullable()->after('order_number');
            $table->string('midtrans_snap_token')->nullable()->after('midtrans_transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'midtrans_transaction_id',
                'midtrans_snap_token',
            ]);
        });
    }
};