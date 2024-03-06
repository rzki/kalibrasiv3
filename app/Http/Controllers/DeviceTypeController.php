<?php

namespace App\Http\Controllers;

use App\Models\DeviceBrand;
use App\Models\DeviceType;
use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = DeviceType::all();
        return view('devices.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = DeviceBrand::all();
        return view('devices.types.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'brand_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        DeviceType::create($validation);

        return to_route('device_types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceType $type)
    {
        $brands = DeviceBrand::all();
        return view('devices.types.edit', compact('brands', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceType $type)
    {
        $validation = $this->validate($request, [
            'brand_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        $type->where('id', $type->id)->update($validation);

        return to_route('device_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceType $type)
    {
        $type->where('id', $type->id)->delete();
        return to_route('device_types.index');
    }
}
