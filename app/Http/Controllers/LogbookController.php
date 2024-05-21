<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
                ->addColumn('name', function ($inventory) {
                    return $inventory->inventories ? $inventory->inventories->devnames->name : '';
                })
                ->addColumn('brand', function ($inventory) {
                    return $inventory->inventories ? $inventory->inventories->brand : '';
                })
                ->addColumn('type', function ($inventory) {
                    return $inventory->inventories ? $inventory->inventories->type : '';
                })
                ->addColumn('sn', function ($inventory) {
                    return $inventory->inventories ? $inventory->inventories->sn : '';
                })
                ->addColumn('inv_number', function ($inventory) {
                    return $inventory->inventories ? $inventory->inventories->inv_number : '';
                })
                ->addColumn('tanggal_pinjam', function ($data) {
                    return $data->tanggal_mulai_pinjam . ' - ' . $data->tanggal_selesai_pinjam;
                })
                ->addColumn('pic', function ($data) {
                    return $data->pic;
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
        $inventories = Inventory::with('devnames')->get();
        $status = ['Tidak Tersedia', 'Tersedia'];
        return view('logbook.create', compact('inventories', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'inventory_id' => $request->inventory_id,
            'tanggal_mulai_pinjam' => $request->tanggal_mulai_pinjam,
            'tanggal_selesai_pinjam' => $request->tanggal_selesai_pinjam,
            'lokasi_pinjam' => $request->lokasi_pinjam,
            'pic' => $request->pic,
            'status' => $request->status
        ]);
        Alert::toast('Log berhasil ditambahkan!', 'success')->hideCloseButton()->autoClose(3000);
        return to_route('logbooks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LogBook $logbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogBook $logbook)
    {
        $inventories = Inventory::with('devnames')->get();
        $status = ['Tidak Tersedia', 'Tersedia'];
        return view('logbook.edit', compact('inventories', 'logbook', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogBook $logbook)
    {
        LogBook::where('logId', $logbook->logId)->update([
            'logId' => Str::orderedUuid(),
            'inventory_id' => $request->inventory_id,
            'tanggal_mulai_pinjam' => $request->tanggal_mulai_pinjam,
            'tanggal_selesai_pinjam' => $request->tanggal_selesai_pinjam,
            'lokasi_pinjam' => $request->lokasi_pinjam,
            'pic' => $request->pic,
            'status' => $request->status
        ]);
        Alert::toast('Log berhasil diperbarui!', 'success')->hideCloseButton()->autoClose(3000);
        return to_route('logbooks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogBook $logbook)
    {
        $logbook->where('logId', $logbook->logId)->delete();
        Alert::toast('Log berhasil dihapus!', 'success')->hideCloseButton()->autoClose(3000);
        return to_route('logbooks.index');
    }
}
