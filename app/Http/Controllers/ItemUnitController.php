<?php

namespace App\Http\Controllers;

use App\Models\ItemUnit;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemUnits = ItemUnit::orderBy('created_at', 'desc')->get();
        return view('units.index', compact('itemUnits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required'
        ]);

        ItemUnit::create($validation);

        return to_route('item_units.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemUnit $itemUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemUnit $itemUnit)
    {
        return view('units.edit', compact('itemUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemUnit $itemUnit)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required'
        ]);

        $itemUnit->where('id', $itemUnit->id)->update($validation);

        return to_route('item_units.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemUnit $itemUnit)
    {
        $itemUnit->where('id', $itemUnit->id)->delete();

        return to_route('item_units.index');
    }
}
