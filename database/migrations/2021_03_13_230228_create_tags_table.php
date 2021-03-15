<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $tag = new Tag();
        $tag->name = "одежда";
        $tag->save();
        $tag = new Tag();
        $tag->name = "обувь";
        $tag->save();
        $tag = new Tag();
        $tag->name = "стиль";
        $tag->save();
        $tag = new Tag();
        $tag->name = "повседневное";
        $tag->save();
        $tag = new Tag();
        $tag->name = "черное";
        $tag->save();
        $tag = new Tag();
        $tag->name = "белое";
        $tag->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
