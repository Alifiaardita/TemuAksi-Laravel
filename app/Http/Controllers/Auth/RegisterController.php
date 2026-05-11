<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:individu,perusahaan',
            'nama'     => 'required|string|max:200',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'email'         => $request->email,
                'password_hash' => bcrypt($request->password),
                'role'          => $request->role,
                'status'        => 'aktif',
            ]);

            if ($request->role === 'individu') {
                UserProfile::create([
                    'user_id'     => $user->id,
                    'nama_lengkap'=> $request->nama,
                ]);
            } else {
                // perusahaan
                $request->validate([
                    'deskripsi' => 'nullable|string',
                    'bidang'    => 'required|string|max:100',
                    'telepon'   => 'required|string|max:20',
                ]);

                CompanyProfile::create([
                    'user_id'        => $user->id,
                    'nama_perusahaan'=> $request->nama,
                    'deskripsi'      => $request->deskripsi,
                    'bidang_industri'=> $request->bidang,
                    'no_telepon'     => $request->telepon,
                ]);
            }

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Gagal registrasi: ' . $e->getMessage()])->withInput();
        }
    }
}
