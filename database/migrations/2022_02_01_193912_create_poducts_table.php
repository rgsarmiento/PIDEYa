<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poducts', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
            $table->string('description',255);            
            $table->foreignId('company_id')->constrained('companies');
            $table->decimal('price',18,2)->default(0);            
            $table->integer('base_quantity');
            $table->integer('stocks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poducts');
    }
}
