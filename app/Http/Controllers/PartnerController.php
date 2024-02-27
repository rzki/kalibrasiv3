<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\PartnerCategory;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();
        return view('partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PartnerCategory::all();

        return view('partners.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'npwp_number' => 'required',
            'partner_category_id' => 'required|integer',
            'status' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        Partner::create($validation);

        return to_route('partners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        $categories = PartnerCategory::all();
        return view('partners.edit', compact('partner', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validation = $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'npwp_number' => 'required',
            'partner_category_id' => 'required|integer',
            'status' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $partner->where('id', $partner->id)->update($validation);

        return to_route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->where('id', $partner->id)->delete();

        return to_route('partners.index');
    }
}
