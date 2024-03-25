<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
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
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        // $vCard = "BEGIN:VCARD\nVERSION:4.0\nFN:$request->name\nTEL;TYPE:cell:$request->phone_number\nEMAIL:$request->email\nEND:VCARD";
        // $qr = QrCode::format('png')
        //         ->size(200)
        //         ->generate($vCard);
        // $path = 'img/vcard/'.$request->name.'.png';
        // Storage::disk('public')->put($path, $qr);


        // VCard::create([
        //     'name'=> $request->name,
        //     'phone_number' => $request->phone_number,
        //     'email' => $request->email,
        //     'address' => $request->address,
        //     'barcode' => $path
        // ]);

        Hospital::create($validation);

        return to_route('hospitals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
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
    public function update(Request $request, Hospital $hospital)
    {
        $validation = $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        $hospital->where('id', $hospital->id)->update($validation);

        return to_route('hospitals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return to_route('hospitals.index');
    }
}
