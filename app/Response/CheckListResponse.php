<?php 

namespace App\Response;

use App\Models\CheckList;

class CheckListResponse {

    public static function item(?CheckList $checkList, array $items): array
    {
        return [
            'id' => $checkList->id ?? null,
            'items' => $items
        ];
    }
    
}