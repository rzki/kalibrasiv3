<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalRequest;
use App\Models\Device;
use App\Models\Hospital;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::all();
        return view('hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HospitalRequest $r)
    {
        Hospital::create([
            'hospitalId' => Str::uuid(),
            'name' => $r->name,
            'phone_number' => $r->phone_number,
            'email' => $r->email,
            'address' => $r->address
        ]);

        return to_route('hospitals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        $devices = Device::where('hospital_id', $hospital->id)->get();
        return view('hospitals.show', compact('hospital', 'devices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HospitalRequest $r, Hospital $hospital)
    {
        $hospital->where('hospitalId', $hospital->hospitalId)->update([
            'name' => $r->name,
            'phone_number' => $r->phone_number,
            'email' => $r->email,
            'address' => $r->address
        ]);

        return to_route('hospitals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->where('hospitalId', $hospital->hospitalId)->delete();

        return to_route('hospitals.index');
    }
}
