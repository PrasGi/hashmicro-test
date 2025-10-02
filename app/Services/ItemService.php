<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function list()
    {
        return Item::orderByDesc('created_at')->get();
    }

    public function get(int $id): ?Item
    {
        return Item::find($id);
    }

    public function create(array $data): Item
    {
        return Item::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'] ?? 0,
        ]);
    }

    public function update(int $id, array $data): Item
    {
        $item = Item::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id): void
    {
        Item::whereKey($id)->delete();
    }
}
