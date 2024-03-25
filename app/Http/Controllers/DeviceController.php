<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceType;
use App\Models\DeviceBrand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::orderBy('created_at', 'desc')->get();

        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = DeviceBrand::all();
        $types = DeviceType::all();
        $status = ['Laik Pakai', 'Tidak Laik Pakai'];
        return view('devices.create', compact('brands', 'types', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'brand_id' => 'required',
            'type_id'=> 'required',
            'serial_number' => 'required',
            'calibration_date' => 'required',
            'next_calibration_date'=> 'required',
            'status'=> 'required',
        ]);

        Device::create($request->all());


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
        $brands = DeviceBrand::all();
        $types = DeviceType::all();
        $status = ['Laik Pakai', 'Tidak Laik Pakai'];
        return view('devices.edit', compact('device', 'brands', 'types', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $validation = $this->validate($request, [
            'barcode' => $device->barcode,
            'name' => 'required',
            'brand_id' => 'required',
            'type_id'=> 'required',
            'serial_number' => 'required',
            'calibration_date' => 'required',
            'next_calibration_date'=> 'required',
            'status'=> 'required',
        ]);

        $device->where('deviceId',$device->deviceId)->update($validation);
        // dd($validation);
        return to_route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->where('id', $device->id)->delete();

        return to_route('devices.index');
    }

    public function generateQrPage()
    {
        return view('devices.generatePage');
    }
    public function qrCodeGenerate(Device $device)
    {

        $deviceID = Str::uuid();

        $qr = QrCode::format('png')
                ->size(285)
                ->generate(route('devices.qr', $deviceID));
        $path = 'img/qr-codes/'. $deviceID .'.png';
        Storage::disk('public')->put($path, $qr);

        Device::create([
            'deviceId' => $deviceID,
            'barcode' => $path
        ]);

        return to_route('devices.index');
    }
    public function printQR(Device $device)
    {
        $customSize = array(0,0,317.49,283.47);
        $pdf = Pdf::loadView('device_pdf', compact('device'))->setPaper($customSize, 'landscape');
        return $pdf->stream($device->deviceId.'.pdf')->header('Content-Type','application/pdf');
    }
}
