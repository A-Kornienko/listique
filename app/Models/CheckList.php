<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CheckList extends Model
{
    public function itemLists(): HasMany
    {
        return $this->hasMany(ItemList::class);
    }
}
