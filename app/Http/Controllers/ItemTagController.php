<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Item;
use App\Models\ItemTag;
use Illuminate\Support\Facades\DB;

class ItemTagController extends Controller
{
    public function searchItemByTag(TagRequest $req) //searching items by tags
    {
        $tags = Tag::all();
        $included_tags = [];
        $excluded_tags = [];
        foreach ($tags as $tag) {
            if ($req->input($tag->id) && !$req->input('exclude-' . $tag->id))
                array_push($included_tags, $tag);
            else if ($req->input('exclude-' . $tag->id)) {
                array_push($excluded_tags, $tag);
            }
        } // included and excluded tags pushing to arrays
        $itemsIdArray = ItemTagController::getItemsIdByTag($included_tags, $excluded_tags);
        $items = ItemTagController::getItemsById($itemsIdArray);
        ItemTagController::download($items);
        /*return view('selected', ['data' => $items]);*/ //use it instead of "ItemTagController::download($items);" for view result on web-page
    }

    private function getItemsIdByTag($included_tags = [], $excluded_tags = [])
    {
        //creating query
        $queryLink = "SELECT DISTINCT item_id FROM item_tags";
        if (count($included_tags) > 0  || count($excluded_tags) > 0)
            $queryLink .= " WHERE";

        foreach ($included_tags as $key => $inc_tag) {
            $queryLink .= " item_id IN ";
            $tag_id = $inc_tag->id;
            if ($key < count($included_tags) - 1)
                $queryLink .= "(SELECT item_id FROM item_tags WHERE tag_id = $tag_id) AND";
            else {
                $queryLink .= "(SELECT item_id FROM item_tags WHERE tag_id = $tag_id)";
            }
        }

        if (count($included_tags) > 0 && count($excluded_tags) > 0)
            $queryLink .= " AND ";

        foreach ($excluded_tags as $key => $exc_tag) {
            $queryLink .= " item_id NOT IN ";
            $tag_id = $exc_tag->id;
            if ($key < count($excluded_tags) - 1)
                $queryLink .= "(SELECT item_id FROM item_tags WHERE tag_id = $tag_id) AND";
            else {
                $queryLink .= "(SELECT item_id FROM item_tags WHERE tag_id = $tag_id)";
            }
        }

        //selecting items id
        $items = DB::select($queryLink);
        return $items;
    }

    private function getItemsById($itemsIdArray = [])
    {
        //creating query
        if (count($itemsIdArray) <= 0)
            return null;
        $array = "";
        foreach ($itemsIdArray as $key => $item) {
            if ($key < count($itemsIdArray) - 1)
                $array .= $item->item_id . ",";
            else
                $array .= $item->item_id;
            ItemTagController::itemShowCounterAdd($item->item_id);
        }

        //selecting items
        $query = "SELECT * FROM items WHERE id IN ($array)";
        $items = DB::select($query);
        return $items;
    }

    private function itemShowCounterAdd($itemId = null)
    {
        //show count increment
        if ($itemId == null)
            return;
        $item = Item::find($itemId);
        $item->show_count = $item->show_count + 1;
        $item->save();
    }

    public function download($items = null)
    {
        // csv result
        if ($items == null)
            return;
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $output = fopen("php://output", "w");
        fputcsv($output, array("id", "name"), "-");

        foreach ($items as $item) {
            $array = json_decode(json_encode($item), true);
            fputcsv($output, [$item->id, $item->name], "-");
        }
        fclose($output);

        return response()->json([
            'test' => $items
        ]);
    }
}
