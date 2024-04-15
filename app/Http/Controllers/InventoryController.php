<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::orderByDesc('created_at')->get();
        $devNames = DeviceName::all();
        return view('inventories.index', compact('inventories','devNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $names = DeviceName::all();
        $statuses = ['Ready', 'Not Ready'];
        return view('inventories.create', compact('names','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        $inv_id = Str::orderedUuid();

        // Insert the rest of the data
        Inventory::create([
            'inv_id' => $inv_id,
            'device_name'   => $request->device_name,
            'brand'         => $request->brand,
            'type'          => $request->type,
            'sn'            => $request->sn,
            'inv_number'    => $request->inv_number,
            'procurement_year' => $request->procurement_year,
            'last_calibrated_date' => $request->last_calibrated_date,
            'next_calibrated_date' => $request->next_calibrated_date,
            'pic'           => $request->pic,
            'location'      => $request->location,
            'status'        => $request->status
        ]);

        return to_route('inventories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $names = DeviceName::all();
        $statuses = ['Ready', 'Not Ready'];
        return view('inventories.edit', compact('inventory','names','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->where('inv_id', $inventory->inv_id)->update([
            'inv_id' => $inventory->inv_id,
            'device_name'   => $request->device_name,
            'brand'         => $request->brand,
            'type'          => $request->type,
            'sn'            => $request->sn,
            'inv_number'    => $request->inv_number,
            'procurement_year' => $request->procurement_year,
            'last_calibrated_date' => $request->last_calibrated_date,
            'next_calibrated_date' => $request->next_calibrated_date,
            'pic'           => $request->pic,
            'location'      => $request->location,
            'status'        => $request->status
        ]);

        return to_route('inventories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->where('inv_id', $inventory->inv_id)->delete();
        return to_route('inventories.index');
    }
}
