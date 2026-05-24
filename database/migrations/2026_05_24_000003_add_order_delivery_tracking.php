<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (! Schema::hasColumn('orders', 'delivery_days')) {
                    $table->unsignedTinyInteger('delivery_days')->default(3)->after('total_amount');
                }
                if (! Schema::hasColumn('orders', 'received_at')) {
                    $table->dateTime('received_at')->nullable()->after('delivery_days');
                }
            });

            DB::table('orders')->whereNull('delivery_days')->update(['delivery_days' => 3]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'received_at')) {
                    $table->dropColumn('received_at');
                }
                if (Schema::hasColumn('orders', 'delivery_days')) {
                    $table->dropColumn('delivery_days');
                }
            });
        }
    }
};
