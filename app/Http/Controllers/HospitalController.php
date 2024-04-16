<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Hospital;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\HospitalRequest;
use Yajra\DataTables\Facades\DataTables;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $hospitals = Hospital::orderByDesc('created_at')->get();
            // $inventories = Inventory::with('devnames')->orderByDesc('created_at')->get();
            return DataTables::of($hospitals)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="action-form d-flex justify-content-center">
                        <a href="' . route('hospitals.edit', ['hospital' => $row->hospitalId]) . '" class="btn btn-primary mr-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <form action="' . route('hospitals.destroy', ['hospital' => $row->hospitalId]) . '" method="post"
                            class="delete-form"  onsubmit="return confirm(`Apakah yakin ingin menghapus data ini?`)";>
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('hospitals.index');
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
