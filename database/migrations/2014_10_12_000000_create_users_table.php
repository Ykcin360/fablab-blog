<?php

use App\Models\State;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('address', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('profile_description')->nullable();
            $table->string('phone_number', 13)->nullable();
            $table->date('birthdate')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('password', 60);
            $table->boolean('is_admin')->default(false);

            // $table->string('state')->default('created');
            $table->rememberToken();
            $table->timestamps();

            $table->foreignIdFor(State::class)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
