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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->comment('Название объявления');
            $table->string('description', 1000)->comment('Описание объявления');
            $table->bigInteger('price')->default(0)->comment('Цена в объявлении');
            $table->text('photo')->nullable()->comment('Ссылка на главное фото в объявлении');
            $table->text('photos')->nullable()->comment('Ссылки на остальные фото в объявлении');
            $table->timestamps();
            $table->index('price', 'ads_price_index');
            $table->index('created_at', 'ads_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
