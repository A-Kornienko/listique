<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use App\Models\ItemList;
use App\Response\CheckListResponse;
use App\Response\ItemListResponse;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(111);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $checkList = CheckList::create();


        $itemlists = [];
        foreach ($request->all() as $item) {
            $itemlists[] = new ItemList([
                'label' => $item['label'], 
                'check_list_id' => $checkList->id,
                'status' => 'pending'
            ]);
        }

        $checkList->itemLists()->saveMany($itemlists);

        return response(CheckListResponse::item($checkList, ItemListResponse::lists($checkList)));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $checkList = CheckList::find($id);

        return response(CheckListResponse::item($checkList, ItemListResponse::lists($checkList)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $data = [];
        foreach ($request->all() as $item) {

            $itemList = ItemList::find($item['id']);

            if (!$itemList) {
                continue;
            }

            if (!$itemList->update($item)) {
                continue;
            }

            $data[] = ItemListResponse::item($itemList);
        }

        return response($data);
    }

    public function changeStatus(int $id)
    {
        $itemList = ItemList::find($id);

        $status = collect(['done', 'pending']);

        $resault = $status->reject(fn($value) => $value === $itemList->status);

        $itemList->status = $resault->first();

        $itemList->save();

        if (!$itemList) {
            return response([]);
        }

        return response(ItemListResponse::item($itemList));
    }
}
