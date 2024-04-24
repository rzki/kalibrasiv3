<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PasswordRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('name', '!=', 'Superadmin')->orderByDesc('updated_at')->get();
        $title = 'Delete User?';
        $message = "Are you sure want to delete this data?";
        confirmDelete($title, $message);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('code', '!=', 'superadmin')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        User::create([
            'userId' => Str::orderedUuid(),
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('Calibration24!'),
            'role_id' => $request['role_id']
        ]);

        Alert::toast('User Added Succesfully!', 'success');

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::where('code', '!=', 'superadmin')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->where('userId', $user->userId)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => $request['role_id']
        ]);

        Alert::toast('User Updated Successfully!', 'success');

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->where('userId', $user->userId)->delete();

        return to_route('users.index');
    }

    public function profile(User $user)
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function editProfile(User $user)
    {
        $user = auth()->user();
        return view('users.profile_edit', compact('user'));
    }

    public function updateProfile(Request $r, User $user)
    {
        $validation = $this->validate($r, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        Alert::toast('Profile Updated Successfully!', 'success');

        $user->where('userId', $user->userId)->update($validation);
        return to_route('users.profile');
    }

    public function editPassword(User $user)
    {
        return view('users.password_edit', compact('user'));
    }

    public function updatePassword(PasswordRequest $request, User $user)
    {
        $user->where('userId', auth()->user()->userId)->update([
            'password' => Hash::make($request->password)
        ]);
        Alert::toast('Password Updated Successfully!', 'success');
        return to_route('users.profile');
    }
    public function resetPassword(User $user)
    {
        $user->where('userId', $user->userId)->update([
            'password' => Hash::make('Calibration24!')
        ]);
        Alert::toast('Password Reset Successfully!', 'success');
        return to_route('users.index');
    }

    public function userImport(Request $request)
    {
        $request->validate([
            'file' => 'file|required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        Alert::toast('User Imported Successfully!', 'success');

        return to_route('users.index');
    }
}
