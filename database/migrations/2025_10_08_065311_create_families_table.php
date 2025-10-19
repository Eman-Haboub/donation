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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
             $table->string('alias');
            $table->string('public_region');
            $table->text('information');
            $table->text('img');
            $table->integer('members_count');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->integer('donated')->default(0);
            $table->integer('goal')->default(100);
             $table->string('real_name');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->decimal('income', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->text('national_id_encrypted')->nullable();
            $table->json('kyc_documents')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_familes');
    }
};
