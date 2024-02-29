<?php

namespace App\Http\Controllers;

use App\Models\DeviceLocation;
use Illuminate\Http\Request;

class DeviceLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = DeviceLocation::orderBy('created_at', 'desc')->get();

        return view('devices.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.locations.create');
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

        DeviceLocation::create($validation);

        return to_route('device_locations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceLocation $deviceLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceLocation $location)
    {
        return view('devices.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceLocation $location)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required'
        ]);

        $location->where('id', $location->id)->update($validation);

        return to_route('device_locations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceLocation $location)
    {
        $location->where('id', $location->id)->delete();

        return to_route('device_locations.index');
    }
}
