<?php

use App\Models\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('show_count')->default(0);
        });

        $item = new Item();
        $item->name = "Кроссовки Nike";
        $item->show_count = 5;
        $item->save();
        $item = new Item();
        $item->name = "Джинсы Levi's";
        $item->show_count = 10;
        $item->save();
        $item = new Item();
        $item->name = "Куртка NORMANN";
        $item->show_count = 0;
        $item->save();
        $item = new Item();
        $item->name = "Футболка Adidas";
        $item->show_count = 1;
        $item->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
