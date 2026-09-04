<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create($pemesananId)
    {
        $pemesanan = Pemesanan::with(['kamar.kos'])
            ->where('user_id', auth()->id())
            ->findOrFail($pemesananId);

        $status = strtolower(trim($pemesanan->status ?? ''));

        if (!in_array($status, ['dikonfirmasi', 'selesai', 'berhenti'], true)) {
            return redirect()
                ->route('user.status')
                ->with(
                    'error',
                    'Feedback hanya bisa diberikan untuk pesanan yang sudah dikonfirmasi.'
                );
        }

        if ($pemesanan->feedback) {
            return redirect()
                ->route('user.status')
                ->with(
                    'error',
                    'Kamu sudah memberikan feedback untuk pesanan ini.'
                );
        }

        return view(
            'user.feedback',
            compact('pemesanan')
        );
    }

    public function store(Request $request, $pemesananId)
    {
        $pemesanan = Pemesanan::with('kamar')
            ->where('user_id', auth()->id())
            ->findOrFail($pemesananId);

        $status = strtolower(trim($pemesanan->status ?? ''));

        if (!in_array($status, ['dikonfirmasi', 'selesai', 'berhenti'], true)) {
            return redirect()
                ->route('user.status')
                ->with(
                    'error',
                    'Pesanan ini belum bisa diberi feedback.'
                );
        }

        if ($pemesanan->feedback) {
            return redirect()
                ->route('user.status')
                ->with(
                    'error',
                    'Kamu sudah memberikan feedback untuk pesanan ini.'
                );
        }

        $validated = $request->validate([
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'komentar' => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ], [
            'rating.required' => 'Silakan pilih rating.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'komentar.required' => 'Komentar wajib diisi.',
            'komentar.min' => 'Komentar minimal 3 karakter.',
            'komentar.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'kamar_id' => $pemesanan->kamar_id,
            'pemesanan_id' => $pemesanan->id,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
        ]);

        return redirect()
            ->route('user.status')
            ->with(
                'success',
                'Feedback untuk Kamar ' .
                ($pemesanan->kamar->nomor_kamar ?? '-') .
                ' berhasil dikirim. Terima kasih!'
            );
    }

    public function adminIndex()
    {
        $feedbacks = Feedback::with([
            'user',
            'kamar.kos',
            'pemesanan',
        ])
            ->latest()
            ->get();

        return view(
            'admin.feedback.index',
            compact('feedbacks')
        );
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()
            ->route('admin.feedback.index')
            ->with(
                'success',
                'Feedback berhasil dihapus.'
            );
    }
}