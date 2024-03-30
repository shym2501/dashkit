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
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropForeign('flash_sales_product_id_foreign');
            $table
                ->bigInteger('product_id')
                ->unsigned()
                ->index()
                ->after('updated_at');
        });
    }
};
