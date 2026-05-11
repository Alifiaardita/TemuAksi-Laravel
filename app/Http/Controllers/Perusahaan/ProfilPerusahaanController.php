<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilPerusahaanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $user = User::with('companyProfile')->find($userId);

        $company = $user->companyProfile;

        return view('perusahaan.profil', compact('user', 'company'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_perusahaan' => 'required|string|max:200',
            'deskripsi'       => 'nullable|string',
            'bidang_industri' => 'nullable|string|max:100',
            'no_telepon'      => 'nullable|string|max:20',
            'alamat'          => 'nullable|string',
            'website'         => 'nullable|string|max:255',
            'password'        => 'nullable|min:6'
        ]);

        CompanyProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_perusahaan' => $request->nama_perusahaan,
                'deskripsi'       => $request->deskripsi,
                'bidang_industri' => $request->bidang_industri,
                'no_telepon'      => $request->no_telepon,
                'alamat'          => $request->alamat,
                'website'         => $request->website,
            ]
        );

        if ($request->filled('password')) {
            User::where('id', $user->id)->update([
                'password_hash' => bcrypt($request->password)
            ]);
        }

        return redirect()
            ->route('perusahaan.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
