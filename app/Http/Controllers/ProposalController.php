<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\KategoriEvent;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function create(int $sponsor_id)
    {

        $sponsor  = Sponsor::findOrFail($sponsor_id);
        $kategori = KategoriEvent::all();
        return view('organizer.form_pengajuan', compact('sponsor', 'kategori'));
    }

    public function store(Request $request)
    {
        // dd('MASUK STORE');
        $request->validate([
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori'    => 'required|string',
            'lokasi'      => 'required|string|max:100',
            'tanggal'     => 'required|date',
            'target_dana' => 'required|integer|min:0',
            'sponsor_id'  => 'required|exists:sponsor,id',
            'file_proposal'=> 'nullable|mimes:pdf|max:5120',
        ]);

        $fileName = null;
        if ($request->hasFile('file_proposal')) {
            $fileName = time() . '_' . $request->file('file_proposal')->getClientOriginalName();
            $request->file('file_proposal')->storeAs('proposals', $fileName, 'public');
        }

        Proposal::create([
            'user_id'      => Auth::id(),
            'sponsor_id'   => $request->sponsor_id,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'kategori'     => $request->kategori,
            'lokasi'       => $request->lokasi,
            'tanggal'      => $request->tanggal,
            'target_dana'  => $request->target_dana,
            'file_proposal'=> $fileName,
        ]);

        return redirect()->route('proposal.riwayat')->with('success', 'Proposal berhasil diajukan!');
    }

    public function riwayat()
    {
        $proposals = Proposal::with('sponsor')
            ->forUser(Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('organizer.riwayat_pengajuan', compact('proposals'));
    }

    public function edit(int $id)
    {
        $proposal = Proposal::forUser(Auth::id())->findOrFail($id);

        if (!$proposal->isEditable()) {
            return redirect()->route('proposal.riwayat')
                ->with('error', "Proposal tidak bisa diedit karena sudah masuk tahap {$proposal->status}.");
        }

        $kategori = KategoriEvent::all();
        return view('organizer.edit_proposal', compact('proposal', 'kategori'));
    }

    public function update(Request $request, int $id)
    {
        $proposal = Proposal::forUser(Auth::id())->findOrFail($id);

        if (!$proposal->isEditable()) {
            return redirect()->route('proposal.riwayat')
                ->with('error', 'Proposal tidak bisa diedit.');
        }

        $request->validate([
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori'    => 'required|string',
            'lokasi'      => 'required|string',
            'tanggal'     => 'required|date',
            'target_dana' => 'required|integer|min:0',
        ]);

        $proposal->update($request->only(['judul','deskripsi','kategori','lokasi','tanggal','target_dana']));

        return redirect()->route('proposal.riwayat')->with('success', 'Proposal berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $proposal = Proposal::forUser(Auth::id())->findOrFail($id);
        $proposal->delete();
        return redirect()->route('proposal.riwayat')->with('success', 'Proposal berhasil dihapus.');
    }
}
