<?php

namespace App\Http\Controllers;

use App\Models\DeviceBrand;
use Illuminate\Http\Request;

class DeviceBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = DeviceBrand::all();
        return view('devices.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
        ]);

        DeviceBrand::create($validation);

        return to_route('device_brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceBrand $deviceBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceBrand $brand)
    {
        return view('devices.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceBrand $brand)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
        ]);

        $brand->where('id', $brand->id)->update($validation);

        return to_route('device_brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceBrand $brand)
    {
        $brand->where('id', $brand->id)->delete();
        return to_route('device_brands.index');
    }
}
