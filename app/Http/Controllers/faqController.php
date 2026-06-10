<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        return view('organizer.faq');
    }

    public function store(Request $request)
{
    $request->validate([
        'pertanyaan' => 'required|string|max:255',
        'detail' => 'nullable|string',
    ]);

    \App\Models\FaqQuestion::create([
        'user_id' => auth()->id(),
        'pertanyaan' => $request->pertanyaan,
        'detail' => $request->detail,
    ]);

    return redirect()->back()->with('success', 'Pertanyaan berhasil dikirim');
}

}
