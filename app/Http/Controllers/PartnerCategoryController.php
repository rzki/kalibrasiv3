<?php

namespace App\Http\Controllers;

use App\Models\PartnerCategory;
use Illuminate\Http\Request;

class PartnerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partnerCategories = PartnerCategory::orderBy('created_at', 'desc')->get();
        return view('partners.categories.index', compact('partnerCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partners.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required'
        ]);

        PartnerCategory::create($validation);

        return to_route('partner_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PartnerCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartnerCategory $category)
    {
        return view('partners.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartnerCategory $category)
    {
        $validation = $this->validate($request, [
            'name' => 'required'
        ]);

        $category->where('id', $category->id)->update($validation);

        return to_route('partner_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartnerCategory $category)
    {
        $category->where('id', $category->id)->delete();

        return to_route('partner_categories.index');
    }
}
