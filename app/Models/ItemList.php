<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    protected $fillable = ['label', 'check_list_id', 'status'];
}
