<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->bigInteger('price');
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('total')->nullable();
            $table
                ->bigInteger('category_id')
                ->unsigned()
                ->nullable()
                ->index();
            $table->string('link', 255);
            $table->boolean('is_visibled')->default(1);
            $table
                ->bigInteger('flash_sale_id')
                ->unsigned()
                ->nullable()
                ->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreign('flash_sale_id')
                ->references('id')
                ->on('flash_sales')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
