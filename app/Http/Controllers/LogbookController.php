<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $logbooks = LogBook::with('inventories')->orderByDesc('created_at')->get();
            return DataTables::of($logbooks)
                ->addIndexColumn()
                ->addColumn('name', function($inventory){
                    return $inventory->inventories ? $inventory->inventories->name : '';
                })
                ->addColumn('brand', function($inventory){
                    return $inventory->inventories ? $inventory->inventories->brand : '';
                })
                ->addColumn('type', function($inventory){
                    return $inventory->inventories ? $inventory->inventories->type : '';
                })
                ->addColumn('sn', function($inventory){
                    return $inventory->inventories ? $inventory->inventories->sn : '';
                })
                ->addColumn('inv_number', function($inventory){
                    return $inventory->inventories ? $inventory->inventories->inv_number : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="action-form d-flex justify-content-center">
                        <a href="' . route('logbooks.edit', ['logbook' => $row->logId]) . '" class="btn btn-primary mr-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <form action="' . route('logbooks.destroy', ['logbook' => $row->logId]) . '" method="post"
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
        return view('logbook.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::all();
        return view('logbook.create', compact('inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogBook $logBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogBook $logBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogBook $logBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogBook $logBook)
    {
        //
    }
}
