<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sortType extends Model
{
    use HasFactory;
    protected $table = 'sort_types';
    protected $guarded = false;
    public $timestamps = false;

    public function getAllSortedBy($items)
    {
        switch ($this->Type) {
            case "NumAsc":
                return $items->sortBy('order_num')->values()->all();
            case "NumDes":
                return $items->sortBy('order_num')->reverse()->values()->all();
            case "AlphAsc":
                return $items->sortBy('content', SORT_STRING)->values()->all();
            case "AlphDes":
                return $items->sortBy('content', SORT_STRING)->reverse()->values()->all();
        }
    }
}
