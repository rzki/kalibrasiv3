<?php

namespace App\Http\Controllers;

use App\Models\DeviceCategory;
use Illuminate\Http\Request;

class DeviceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DeviceCategory::orderBy('created_at', 'desc')->get();
        return view('devices.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);
        DeviceCategory::create($validation);
        return to_route('device_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceCategory $category)
    {
        return view('devices.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceCategory $category)
    {
        $validation = $this->validate($request,[
            'code' => 'required',
            'name' => 'required'
        ]);
        $category->where('id', $category->id)->update($validation);
        return to_route('device_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceCategory $category)
    {
        $category->where('id', $category->id)->delete();
        return to_route('device_categories.index');
    }
}
