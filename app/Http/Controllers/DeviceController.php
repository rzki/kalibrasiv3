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
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::orderBy('created_at', 'desc')->paginate(100);

        return view('devices.index', compact('devices'));
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
        // $validation = $this->validate($request, [
        //     'barcode' => $device->barcode,
        //     'name_id' => 'required',
        //     'brand' => 'required',
        //     'type'=> 'required',
        //     'hospital_id' => 'required',
        //     'serial_number' => 'required',
        //     'calibration_date' => 'required',
        //     'status'=> 'required',
        // ]);

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
        // DB::disableQueryLog();

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
        // DB::table('devices')->insert($devices);

        return to_route('devices.index');
    }
    // public function qrCodeGenerate(Request $request, Device $device)
    // {
    //     $deviceID = Str::uuid();

    //     $qr = QrCode::format('png')
    //             ->size(285)
    //             ->generate(route('devices.qr', $deviceID));
    //     $path = 'img/qr-codes/'. $deviceID .'.png';
    //     Storage::disk('public')->put($path, $qr);

    //     Device::create([
    //         'deviceId' => $deviceID,
    //         'barcode' => $path
    //     ]);

    //     return to_route('devices.index');
    // }
    public function printQR(Device $device)
    {
        // dd($device);
        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('devices.device_pdf', compact('device'))->setPaper($customSize);
        return $pdf->stream($device->deviceId.'.pdf')->header('Content-Type','application/pdf');
    }

    public function printEmptyQR()
    {
        $devices = DB::table('devices')->where('name_id', '=', null)->get();
        // dd($devices);
        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('devices.empty_multi_qr', compact('devices'))->setPaper($customSize);
        return $pdf->stream('QR_'.Carbon::today().'.pdf')->header('Content-Type','application/pdf');
    }
}
