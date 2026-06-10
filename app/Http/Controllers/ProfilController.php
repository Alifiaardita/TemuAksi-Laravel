<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::with('userProfile')
            ->findOrFail(Auth::id());

        return view('organizer.profil', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'nama_lengkap'  => 'required|string|max:150',
        'email'         => 'required|email|unique:users,email,' . $user->id,
        'username'      => 'nullable|string|max:100',
        'no_telepon'    => 'nullable|string|max:20',
        'tanggal_lahir' => 'nullable|date',
        'gender'        => 'nullable|in:Laki-laki,Perempuan',
        'avatar'        => 'nullable|image|max:2048',
        'password'      => 'nullable|min:8',
    ]);

    // update user
    User::where('id', $user->id)->update([
        'email' => $request->email
    ]);

    if ($request->filled('password')) {
        User::where('id', $user->id)->update([
            'password_hash' => bcrypt($request->password)
        ]);
    }

    // profile data
    $profileData = [
        'nama_lengkap'  => $request->nama_lengkap,
        'username'      => $request->username,
        'no_telepon'    => $request->no_telepon,
        'tanggal_lahir' => $request->tanggal_lahir,
        'gender'        => $request->gender,
    ];

    if ($request->hasFile('avatar')) {
        $profileData['avatar_url'] = $request
            ->file('avatar')
            ->store('avatars', 'public');
    }

    UserProfile::updateOrCreate(
        ['user_id' => $user->id],
        $profileData
    );

    return back()->with('success', 'Profil berhasil diperbarui.');
}
}
