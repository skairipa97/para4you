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
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('username')->unique(); // Unique username for login
            $table->string('name'); // Full name
            $table->string('email')->unique(); // Unique email
            $table->string('tel'); // Telephone number
            $table->string('password'); // Hashed password
            $table->enum('gender', ['male', 'female', 'secret']); // Gender options
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created and updated timestamps
        });

        // Password reset tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key (email)
            $table->string('token'); // Password reset token
            $table->timestamp('created_at')->nullable(); // Token creation timestamp
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID as primary key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // User ID with foreign key
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // User agent string (browser details)
            $table->longText('payload'); // Serialized session data
            $table->integer('last_activity')->index(); // Last activity timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order of creation
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
