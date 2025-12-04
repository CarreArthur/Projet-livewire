<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Dans database/migrations/xxxx_xx_xx_xxxxxx_create_ingredients_table.php

    public function up(): void
        {
            Schema::create('ingredients', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->enum('category', ['bun_top', 'bun_bottom', 'meat', 'cheese', 'veggie', 'sauce']);
                $table->integer('price'); // Prix en centimes
                $table->integer('calories')->default(0);
                $table->string('image_path')->nullable();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
