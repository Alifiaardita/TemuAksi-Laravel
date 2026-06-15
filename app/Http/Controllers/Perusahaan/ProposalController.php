<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Pendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalController extends Controller
{
    /**
     * Semua proposal yang masuk ke sponsor milik perusahaan ini
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Hitung metric dari SEMUA proposal milik sponsor (tidak terpengaruh filter)
        $allProposals = Proposal::whereHas('sponsor', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->get();

        $totalProposal    = $allProposals->count();
        $proposalMenunggu = $allProposals->where('status', 'terkirim')->count();
        $proposalDidanai  = $allProposals->where('status', 'pendanaan')->count();

        // Query proposal untuk tabel, dengan filter status (jika ada)
        $query = Proposal::with([
            'user.userProfile',
            'sponsor'
        ])
        ->whereHas('sponsor', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $proposals = $query->latest()->get();

        return view('perusahaan.daftar_proposal', compact(
            'proposals', 'totalProposal', 'proposalMenunggu', 'proposalDidanai'
        ));
    }

    public function detail($id)
    {
        $proposal = $this->authorizedProposal($id);

        return view('perusahaan.detail_proposal', compact('proposal'));
    }

    public function updateStatus(Request $request, $id)
    {
        $proposal = $this->authorizedProposal($id);

        $request->validate([
            'status' => 'required|in:terkirim,pendanaan,selesai,ditolak'
        ]);

        $proposal->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('perusahaan.proposal.index')
            ->with('success', 'Status proposal berhasil diperbarui.');
    }

    public function formPendanaan($id)
    {
        $proposal = $this->authorizedProposal($id);

        return view('perusahaan.form_pendanaan', compact('proposal'));
    }

    public function storePendanaan(Request $request, $id)
    {
        $proposal = $this->authorizedProposal($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        Pendanaan::create([
            'proposal_id'   => $proposal->id,
            'perusahaan_id' => Auth::id(),
            'jumlah_dana'   => $request->jumlah
        ]);

        $proposal->update([
            'status' => 'selesai'
        ]);

        return redirect()
            ->route('perusahaan.proposal.index')
            ->with('success', 'Pendanaan berhasil dikirim.');
    }

    public function generateMou($id)
    {
        $proposal = $this->authorizedProposal($id);

        $proposal->load([
            'user.userProfile',
            'sponsor.user.companyProfile'
        ]);

        $pdf = Pdf::loadView('perusahaan.pdf_mou', compact('proposal'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('MOU_' . $proposal->id . '.pdf');
    }

    public function destroy($id)
    {
        $proposal = $this->authorizedProposal($id);
        $proposal->delete();

        return redirect()
            ->route('perusahaan.proposal.index')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    public function setujui(Request $request, $id)
    {
        $proposal = $this->authorizedProposal($id);
        
        // Ubah status ke pendanaan
        $proposal->update(['status' => 'pendanaan']);

        // Simpan data pendanaan
        Pendanaan::create([
            'proposal_id'   => $proposal->id,
            'perusahaan_id' => Auth::id(),
            'jumlah_dana'   => $request->jumlah_dana,
        ]);

        return redirect()
            ->route('perusahaan.proposal.index')
            ->with('success', 'Proposal berhasil disetujui dan masuk ke tahap pendanaan.');
    }

    public function tolak($id)
    {
        $proposal = $this->authorizedProposal($id);
        $proposal->update(['status' => 'ditolak']);

        return redirect()
            ->route('perusahaan.proposal.index')
            ->with('success', 'Proposal telah ditolak.');
    }
    
    /**
     * Pastikan proposal milik sponsor perusahaan login
     */
    private function authorizedProposal($id)
    {
        $userId = Auth::id();

        return Proposal::with([
                'user.userProfile',
                'sponsor'
            ])
            ->whereHas('sponsor', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->findOrFail($id);
    }
}
