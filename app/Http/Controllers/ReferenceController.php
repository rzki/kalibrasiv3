<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $references = Reference::orderBy('updated_at', 'DESC')->get();
        return view('references.index', compact('references'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('references.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        Reference::create($request->all());

        return to_route('references.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reference $reference)
    {
        return view('references.edit', compact('reference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reference)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $references = Reference::find($reference);
        $references->update($request->all());

        return to_route('references.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reference $reference)
    {
        $references = Reference::find($reference);
        $reference->delete();

        return to_route('references.index');
    }
}
