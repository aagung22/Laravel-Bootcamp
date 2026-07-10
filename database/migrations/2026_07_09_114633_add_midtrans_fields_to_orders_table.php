<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 🔥 Kolom untuk Midtrans
            $table->string('order_id')->unique()->nullable()->after('id');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('date')->nullable()->after('status');
            
            // 🔥 Tambahan kolom customer_email (opsional)
            $table->string('customer_email')->nullable()->after('customer_name');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'payment_status', 'date', 'customer_email']);
        });
    }
};