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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('phone', 50);
            $table->string('company', 150)->nullable();
            $table->string('location', 255);
            $table->string('partnership_type', 100);
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'processed', 'rejected'])->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            // Index untuk memudahkan filter dan sorting di admin CMS
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};
