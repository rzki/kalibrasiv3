<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\DeviceCategory;
use App\Models\DeviceLocation;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::orderBy('created_at', 'desc')->get();

        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DeviceCategory::all();
        $locations = DeviceLocation::all();
        $vendors = ['Supplier', 'Vendor'];
        $conditions = ['Sangat Buruk', 'Buruk', 'Baik', 'Sangat Baik'];
        $riskLevel = ['Rendah', 'Menengah', 'Tinggi'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('devices.create', compact('categories', 'locations', 'vendors', 'conditions', 'riskLevel', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'type' => 'required',
            'manufacturer' => 'required',
            'serial_number' => 'required',
            'device_category_id' => 'required',
            'device_location_id' => 'required',
            'condition' => 'required',
            'risk_level' => 'required',
            'vendor' => 'required',
            'status' => 'required'
        ]);

        Device::create($validation);

        return to_route('devices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        $categories = DeviceCategory::all();
        $locations = DeviceLocation::all();
        $vendors = ['Supplier', 'Vendor'];
        $conditions = ['Sangat Buruk', 'Buruk', 'Baik', 'Sangat Baik'];
        $riskLevel = ['Rendah', 'Menengah', 'Tinggi'];
        $status = ['Aktif', 'Tidak Aktif'];
        return view('devices.edit', compact('device','categories', 'locations', 'vendors', 'conditions', 'riskLevel', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $validation = $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'type' => 'required',
            'manufacturer' => 'required',
            'serial_number' => 'required',
            'device_category_id' => 'required',
            'device_location_id' => 'required',
            'condition' => 'required',
            'risk_level' => 'required',
            'vendor' => 'required',
            'status' => 'required'
        ]);

        $device->where('id', $device->id)->update($validation);

        return to_route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->where('id', $device->id)->delete();

        return to_route('devices.index');
    }
}
