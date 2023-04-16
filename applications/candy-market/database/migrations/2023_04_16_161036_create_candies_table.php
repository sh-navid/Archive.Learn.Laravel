<?php

use App\Models\User;
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
        // This is not the best data model; this is just for teaching and learning
        Schema::create('candies', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->string("title");
            $table->text("description");
            $table->integer("price"); //2500T
            $table->integer("amount"); //12
            $table->integer("type"); //1 KG, 2 Piece, 3 box
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candies');
    }
};
