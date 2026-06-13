<?php

namespace App\Http\Controllers\Perusahaan;

use App\Models\FaqCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FaqCompanyController extends Controller
{
    public function index()
    {
        $faqs = FaqCompany::latest()->get();
        return view('perusahaan.faq', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        FaqCompany::create([
            'user_id' => Auth::id(),
            'pertanyaan' => $request->pertanyaan,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'Pertanyaan berhasil dikirim!');
    }
}
