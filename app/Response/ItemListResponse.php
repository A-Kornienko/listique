<?php 

namespace App\Response;

use App\Models\CheckList;
use App\Models\ItemList;

class ItemListResponse 
{
    public static function item(ItemList $itemList): array
    {
        return [
            'id' => $itemList->id,
            'label' => $itemList->label,
            'status' => $itemList->status
        ];
    }

    public static function lists(?CheckList $checkList): array 
    {
        $data = [];

        if(!$checkList) {
            return $data;
        }

        foreach ($checkList->itemLists()->get() ?? [] as $item) {
            $data[] = self::item($item);
        }

        return $data;
    }
}