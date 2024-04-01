<?php

namespace App\Http\Controllers;

use App\Models\DeviceName;
use Illuminate\Http\Request;

class DeviceNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $names = DeviceName::get();

        return view('devices.names.index', compact('names'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request,[
            'name' => 'required'
        ]);

        DeviceName::create($validation);

        return to_route('devices_name.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceName $deviceName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceName $deviceName)
    {
        return view('devices.names.edit', compact('deviceName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceName $deviceName)
    {
        $validation = $this->validate($request,[
            'name' => 'required'
        ]);

        $deviceName->where('id',$deviceName->id)->update($validation);

        return to_route('devices_name.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceName $deviceName)
    {
        $deviceName->where('id', $deviceName->id)->delete();

        return to_route('devices_name.index');
    }
}
