<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    // Halaman user
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }

    // Update role user
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()
                ->back()
                ->with('success', 'Role user berhasil diperbarui');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
                ->back()
                ->with('success', 'User berhasil dihapus');
    }
}