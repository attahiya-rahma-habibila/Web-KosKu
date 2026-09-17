<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Kos;

class UlasanController extends Controller
{
    public function index($kosId)
    {
        $kos = Kos::findOrFail($kosId);

        $feedbacks = Feedback::with([
            'user',
            'kamar',
        ])
        ->whereHas('kamar', function ($query) use ($kos) {
            $query->where('kos_id', $kos->id);
        })
        ->latest()
        ->get();

        $ratingRataRata = $feedbacks->avg('rating') ?? 0;
        $jumlahFeedback = $feedbacks->count();

        return view(
            'user.kos.ulasan',
            compact(
                'kos',
                'feedbacks',
                'ratingRataRata',
                'jumlahFeedback'
            )
        );
    }
}
