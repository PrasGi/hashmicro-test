<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(private ItemService $svc) {}

    public function index()
    {
        return view('items.index', ['items' => $this->svc->list()]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'name'  => ['required','string','max:255'],
            'price' => ['required','numeric','min:0'],
            'stock' => ['nullable','integer','min:0'],
        ]);
        $this->svc->create($data);
        return redirect()->route('items.index')->with('ok','Created');
    }

    public function edit(int $id)
    {
        $item = $this->svc->get($id);
        abort_unless($item, 404);
        return view('items.edit', compact('item'));
    }

    public function update(Request $req, int $id)
    {
        $data = $req->validate([
            'name'  => ['sometimes','string','max:255'],
            'price' => ['sometimes','numeric','min:0'],
            'stock' => ['sometimes','integer','min:0'],
        ]);
        $this->svc->update($id, $data);
        return redirect()->route('items.index')->with('ok','Updated');
    }

    public function destroy(int $id)
    {
        $this->svc->delete($id);
        return redirect()->route('items.index')->with('ok','Deleted');
    }

    // API endpoint (opsional untuk penilaian)
    public function apiIndex() { return response()->json(['data'=>$this->svc->list()]); }
    public function apiShow(int $id)
    {
        $item = $this->svc->get($id);
        return $item ? response()->json(['data'=>$item]) : response()->json(['error'=>'Not Found'],404);
    }
}
