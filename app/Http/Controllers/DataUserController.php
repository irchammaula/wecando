<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.datauser', ['pengguna' => $user]);
    }

    public function create()
    {
        return view('admin.datauser');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'string|max:15',
            'balance' => 'numeric|min:0',
            'role_id' => 'required|integer',
            'quota' => 'integer|min:0',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'phone' => $validated['phone'],
            'balance' => $validated['balance'],
            'role_id' => $validated['role_id'],
            'quota' => $validated['quota'],
        ]);

        return redirect()->route('admin.datauser')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'balance' => 'required|numeric|min:0',
            'role_id' => 'required|integer',
            'quota' => 'required|integer|min:0',
            // Jangan mewajibkan password di form jika tidak diperlukan
            'password' => 'nullable|string|min:8', // Jika password diinputkan, maka validasi minimal 8 karakter
        ]);

        // Jika password diinputkan, maka lakukan enkripsi
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'balance' => $validated['balance'],
            'role_id' => $validated['role_id'],
            'quota' => $validated['quota'],
        ];

        // Cek jika password ada di request, jika ada maka enkripsi dan tambahkan ke data update
        if ($request->has('password') && !empty($request->input('password'))) {
            $updateData['password'] = bcrypt($validated['password']);
        }

        // Update data user
        $user->update($updateData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.datauser')->with('success', 'User updated successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.edituser', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.datauser')->with('success', 'User deleted successfully.');
    }
}
