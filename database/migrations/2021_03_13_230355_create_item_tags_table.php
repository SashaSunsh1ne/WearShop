<?php

use App\Models\ItemTag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('tag_id');
        });

        $itemTag = new ItemTag();
        $itemTag->item_id = 1;
        $itemTag->tag_id = 2;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 1;
        $itemTag->tag_id = 3;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 1;
        $itemTag->tag_id = 5;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 2;
        $itemTag->tag_id = 1;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 2;
        $itemTag->tag_id = 4;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 3;
        $itemTag->tag_id = 1;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 3;
        $itemTag->tag_id = 4;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 3;
        $itemTag->tag_id = 6;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 4;
        $itemTag->tag_id = 1;
        $itemTag->save();
        $itemTag = new ItemTag();
        $itemTag->item_id = 4;
        $itemTag->tag_id = 6;
        $itemTag->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_tags');
    }
}
