<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\sortType;
use Attribute;

class ItemsController extends Controller
{
    public function index() {
        $elements = Item::all();
        $sortType = sortType::find(1);

        $elements = $sortType->getAllSortedBy($elements);

        return view('index', compact('elements', 'sortType'));
    }

    public function sort(Request $request, $sortType  = "NumAsc") {
        $type = sortType::find(1);

        $type->update(['Type' => $sortType]);

        return redirect('/');
    }

    public function add(Request $request) {
        $valid = $request->validate([
            'inp' => "required|regex:/[^ ]/",
        ]);

        Item::create([
            'order_num' => count(Item::all()) + 1,
            'content' => $request->inp,
            'edit_mode' => 0
        ]);

        return redirect('/');
    }

    public function edit(Request $request, $index) {
        $item = Item::find($index);

        $item->update(['edit_mode' => true]);

        return redirect('/');
    }

    public function cancel(Request $request, $index) {
        $item = Item::find($index);

        $item->update(['edit_mode' => false]);
        
        return redirect('/');
    }

    public function ok(Request $request, $index) {
        $request->validate([
            'editInp' => "required|regex:/[^ ]/",
        ]);

        $item = Item::find($index);
        $item->update([
            'content' => $request->editInp,
            'edit_mode' => false
        ]);
        return redirect('/');
    }


    public function delete(Request $request, $index) {
        $items = Item::all();
        $delItem = Item::find($index);

        foreach ($items as $item) {
            if ($item->order_num > $delItem->order_num) {
                $item->update(['order_num' => $item->order_num - 1]);
            }
        }

        $delItem->delete();

        return redirect('/');
    }
}
