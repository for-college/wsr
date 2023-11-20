<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();

      $table->string('name', 100);
      $table->string('surname', 100);
      $table->string('patronymic', 100)->nullable();
      $table->string('login')->unique();
      $table->string('password');
      $table->string('photo_file')->nullable();
      $table->string('api_token')->nullable();

      $table->foreignId('role_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->timestamps();
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
