<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $devices = Device::all();
        $users = User::where('name', '!=', 'Superadmin')->get();
        return view('home', compact('devices', 'users'));
    }
}
