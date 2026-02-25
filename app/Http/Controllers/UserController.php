<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\Institution\Models\Center;
use Modules\Institution\Models\TrainerCenter;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        $roles = Role::all();

        if (auth()->user()->hasRole('Super Admin')) {
            $roles = Role::whereIn('name', ['Super Admin', 'Business Admin', 'Center Admin', 'Trainer'])->get();
        } elseif (auth()->user()->hasRole('Business Admin')) {
            $roles = Role::whereIn('name', ['Business Admin', 'Center Admin', 'Trainer'])->get();
        }
        $centers = Center::all();

        return view('user.create', [
            'rolelists' => $roles,
            'centers' => $centers
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'center_id' => $request->center_id, // Set center_id to the same as the creator's center_id
        ]);
        $user->assignRole($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', 'User registered successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $currentRole = $user->getRoleNames();
        $currentCenter = TrainerCenter::where('trainer_id', $user->id)->first();
        $currentCenterData = Center::where('id', $currentCenter->center_id)->first();

        $roles = Role::all();
        $centers = Center::all();

        // dd($user, $currentRole, $currentCenterData, $roles, $centers);

        return view('user.view', [
            'rolelists' => $roles,
            'centers' => $centers,
            // Other details
            'user' => $user,
            'currentRole' => $currentRole,
            'currentCenterData' => $currentCenterData,
        ]);
    }

    public function changePassword()
    {
        return view('user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ], [
            'current_password.required'          => 'Please enter your current password.',
            'current_password.current_password'  => 'The current password you entered is incorrect.',
            'password.required'                  => 'Please enter a new password.',
            'password.confirmed'                 => 'The new password confirmation does not match.',
            'password.min'                       => 'The new password must be at least 8 characters.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('users-change-password')->with('error', 'The current password you entered is incorrect.')->withInput();
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users-change-password')->with('success', 'Password has been updated.');
    }
}
