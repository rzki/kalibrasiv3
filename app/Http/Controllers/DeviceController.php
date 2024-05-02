<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Hospital;
use App\Models\DeviceName;
use App\Jobs\GenerateQRJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $devices = Device::where('user_id', auth()->user()->userId)->with('names')->orderBy('created_at', 'desc')->get();
            return DataTables::of($devices)
                ->addIndexColumn()
                ->addColumn('name_id', function ($deviceName){
                    return $deviceName->names ? $deviceName->names->name : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="action-form d-flex justify-content-center">
                        <a href="' . route('devices.qr', ['device' => $row->deviceId]) . '" class="btn btn-info mr-2" target="__blank"><i class="fa fa-circle-info" aria-hidden="true"></i></a>
                        <a href="' . route('devices.edit', ['device' => $row->deviceId]) . '" class="btn btn-primary mr-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <a href="' . route('devices.print', ['device' => $row->deviceId]) . '" class="btn btn-secondary mr-2"
                            target="__blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <form action="' . route('devices.destroy', ['device' => $row->deviceId]) . '" method="post"
                            class="delete-form" onsubmit="return confirm(`Apakah yakin ingin menghapus data ini?`)";>
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger""><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('checkbox', function ($item) {
                    $item = '<input type="checkbox" name="deviceIds" class="checkboxClass" data-id="'.$item->deviceId.'"/>';
                    return $item;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('devices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        $status = ['Laik Pakai', 'Tidak Laik Pakai'];
        return view('devices.create', compact('hospitals', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'name_id' => 'required',
            'brand' => 'required',
            'type'=> 'required',
            'hospital_id' => 'required',
            'serial_number' => 'required',
            'calibration_date' => 'required',
            'status'=> 'required',
        ]);

        Device::create($validation);


        return to_route('devices.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    public function qrCode(Device $device)
    {
        return view('devices.public.details', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        $hospitals = Hospital::all();
        $names = DeviceName::all();
        $status = ['Laik Pakai', 'Tidak Laik Pakai'];
        return view('devices.edit', compact('device','names', 'hospitals', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $nextCal = Carbon::parse($request->calibration_date)->addYear();

        $device->where('deviceId',$device->deviceId)->update([
            'barcode' => $device->barcode,
            'name_id' => $request->name_id,
            'brand' => $request->brand,
            'type'=> $request->type,
            'hospital_id' => $request->hospital_id,
            'serial_number' => $request->serial_number,
            'location' => $request->location,
            'calibration_date' => $request->calibration_date,
            'next_calibration_date' => $nextCal,
            'status'=> $request->status,
        ]);
        return to_route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->where('id', $device->id)->delete();
        Storage::disk('public')->delete($device->barcode);
        return to_route('devices.index');
    }
    public function destroyAll(Device $device)
    {
        $device->where('id', $device->id)->where('name_id')->delete();
        Storage::disk('public')->delete($device->barcode);
        return to_route('devices.index');
    }

    public function deleteSelected(Request $request)
    {
        $deviceIds = $request->devIds;

        $deleteQR = Device::whereIn('deviceId',explode(",", $deviceIds))->get();

        foreach($deleteQR as $qr){
            $path = $qr->barcode;
            if(Storage::disk('public')->exists($path)){
                Storage::disk('public')->delete($path);
            }
        }

        Device::whereIn('deviceId',explode(",", $deviceIds))->delete();
        return response()->json(['status'=>true, 'message' => "Selected devices successfully deleted!"]);
    }

    public function createQR()
    {
        return view('devices.createQR');
    }
    public function storeQR(Request $request)
    {
        $numberOfDevices = (int) $request->input('number');
        if ($numberOfDevices <= 0) {
            return back()->withErrors(['number' => 'Please enter a valid number of devices.']);
        }

        for ($i = 0; $i < $numberOfDevices; $i++) {
            $deviceID = Str::uuid();
            // Create device data
            $devices[] = [
                'deviceId' => $deviceID,
            ];
        }

        GenerateQRJob::dispatch($devices);

        return to_route('devices.index');
    }
    public function printQR(Device $device)
    {
        // dd($device);
        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('devices.device_pdf', compact('device'))->setPaper($customSize);
        return $pdf->stream('QR_'.$device->deviceId.'.pdf')->header('Content-Type','application/pdf');
    }

    public function printEmptyQR()
    {
        $devices = DB::table('devices')->where('name_id', '=', null)->pluck('barcode');
        // dd($devices);
        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('devices.empty_multi_qr', compact('devices'))->setPaper($customSize);
        return $pdf->stream('QR_Cal_'.Carbon::now()->format('d-m-Y').'_'.uniqid().'.pdf')->header('Content-Type','application/pdf');
    }
    public function printSelected(Request $request)
    {
        $deviceIds = $request->devIds;
        $devices = Device::whereIn('deviceId',explode(",", $deviceIds))->pluck('barcode');

        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('devices.empty_multi_qr', compact('devices'))->setPaper($customSize);
        return $pdf->stream('QR_Cal_'.Carbon::now()->format('d-m-Y').'_'.uniqid().'.pdf')->header('Content-Type','application/pdf');
    }
}
