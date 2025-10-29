<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_auction')->default(false)->after('status');
            $table->decimal('starting_price', 15, 2)->nullable()->after('is_auction');
            $table->decimal('current_bid', 15, 2)->nullable()->after('starting_price');
            $table->decimal('min_bid_increment', 15, 2)->nullable()->after('current_bid');
            $table->timestamp('auction_ends_at')->nullable()->after('min_bid_increment');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_auction', 'starting_price', 'current_bid', 'min_bid_increment', 'auction_ends_at']);
        });
    }
};
