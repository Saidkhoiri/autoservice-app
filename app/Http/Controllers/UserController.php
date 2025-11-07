<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'bookings'])->get();
        return view('owner.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('owner.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        $user->load(['role', 'bookings.serviceType', 'reviews']);
        return view('owner.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('owner.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        if ($user->bookings()->count() > 0) {
            return redirect()->route('owner.users.index')
                ->with('error', 'User tidak dapat dihapus karena memiliki booking');
        }

        $user->delete();

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    public function toggle(User $user)
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('owner.users.index')
                ->with('error', 'Tidak dapat mengubah status diri sendiri');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('owner.users.index')
            ->with('success', "User berhasil {$status}");
    }
}
