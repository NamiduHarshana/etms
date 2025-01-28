<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_xx_xx_create_employees_table.php

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique(); // Ensure phone numbers are unique
            $table->string('password');
            $table->rememberToken(); // Adds support for "remember me" functionality
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees'); // Drops the employees table
    }
};
