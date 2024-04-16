<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inventory;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $devNames = DeviceName::all();
        if($request->ajax()){
            $inventories = Inventory::with('devnames')->orderByDesc('created_at')->get();
            return DataTables::of($inventories)
                ->addIndexColumn()
                ->addColumn('device_name', function($invNames){
                    return $invNames->devnames ? $invNames->devnames->name : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="action-form d-flex justify-content-center">
                        <a href="' . route('inventories.edit', ['inventory' => $row->inventoryId]) . '" class="btn btn-primary mr-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <form action="' . route('inventories.destroy', ['inventory' => $row->inventoryId]) . '" method="post"
                            class="delete-form"  onsubmit="return confirm(`Apakah yakin ingin menghapus data ini?`)";>
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventories.index');
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
        $nextCal = Carbon::parse($request->last_calibrated_date)->addYear();
        // Insert the rest of the data
        Inventory::create([
            'inventoryId'   => $inv_id,
            'device_name'   => $request->device_name,
            'brand'         => $request->brand,
            'type'          => $request->type,
            'sn'            => $request->sn,
            'inv_number'    => $request->inv_number,
            'procurement_year' => $request->procurement_year,
            'last_calibrated_date' => $request->last_calibrated_date,
            'next_calibrated_date' => $nextCal,
            'pic'           => $request->pic,
            'location'      => $request->location,
            'status'        => $request->status
        ]);

        // dd($inv);
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
        $nextCal = Carbon::parse($request->next_calibrated_date)->addYear();

        $inventory->where('inventoryId', $inventory->inventoryId)->update([
            'inventoryId'   => $inventory->inventoryId,
            'device_name'   => $request->device_name,
            'brand'         => $request->brand,
            'type'          => $request->type,
            'sn'            => $request->sn,
            'inv_number'    => $request->inv_number,
            'procurement_year' => $request->procurement_year,
            'last_calibrated_date' => $request->last_calibrated_date,
            'next_calibrated_date' => $nextCal,
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
        $inventory->where('inventoryId', $inventory->inventoryId)->delete();
        return to_route('inventories.index');
    }
}
