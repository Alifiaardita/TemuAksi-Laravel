<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['userProfile', 'companyProfile'])->get();
        return view('admin.user', compact('users'));
    }

    public function create()
    {
        return view('admin.tambah_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,individu,perusahaan',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'email'         => $request->email,
                'password_hash' => bcrypt($request->password),
                'role'          => $request->role,
                'status'        => 'aktif',
            ]);

            if (in_array($request->role, ['individu', 'admin'])) {
                UserProfile::create(['user_id' => $user->id, 'nama_lengkap' => '']);
            } else {
                CompanyProfile::create(['user_id' => $user->id, 'nama_perusahaan' => '']);
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menambah user.']);
        }
    }

    public function edit(int $id)
    {
        $user = User::with(['userProfile', 'companyProfile'])->findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,individu,perusahaan',
            'nama'  => 'required|string|max:200',
        ]);

        $user->update([
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        if ($request->role === 'perusahaan') {
            CompanyProfile::updateOrCreate(
                ['user_id' => $id],
                ['nama_perusahaan' => $request->nama]
            );
        } else {
            UserProfile::updateOrCreate(
                ['user_id' => $id],
                ['nama_lengkap' => $request->nama]
            );
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        // cascade delete handles profiles
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
