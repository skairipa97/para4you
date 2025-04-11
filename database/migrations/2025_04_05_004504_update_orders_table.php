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
        Schema::table('orders', function (Blueprint $table) {
            // Add new fields for enhanced order handling
            $table->string('order_number')->after('id')->nullable();
            $table->string('first_name')->after('user_id')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('email')->after('last_name')->nullable();
            $table->string('address')->after('email')->nullable();
            $table->string('postal_code')->after('address')->nullable();
            $table->string('city')->after('postal_code')->nullable();
            $table->string('phone')->after('city')->nullable();
            $table->string('payment_method')->after('phone')->nullable();
            $table->decimal('total_amount', 10, 2)->after('payment_method')->default(0);
            $table->string('status')->after('total_amount')->default('pending');
            $table->text('order_details')->after('status')->nullable();
        });
        
        // Drop the foreign key constraint first
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'product_id')) {
                // Check if the foreign key constraint exists
                $foreignKeys = collect(Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('orders'))
                    ->map(function($key) {
                        return $key->getName();
                    })->values()->all();
                
                if (in_array('orders_product_id_foreign', $foreignKeys)) {
                    $table->dropForeign('orders_product_id_foreign');
                }
            }
        });
        
        // Now drop the columns
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('orders', 'product_id')) {
                $table->dropColumn('product_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn([
                'order_number', 'first_name', 'last_name', 'email', 
                'address', 'postal_code', 'city', 'phone', 
                'payment_method', 'total_amount', 'status', 'order_details'
            ]);
            
            // Restore old columns
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity')->default(1);
        });
    }
};
