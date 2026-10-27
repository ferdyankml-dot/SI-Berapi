<?php

namespace App\Http\Controllers;

use App\Models\DisasterHistory;
use App\Models\Volcano;
use Illuminate\Http\Request;

class DisasterHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = DisasterHistory::with('volcano');

        if ($request->filled('volcano_id')) {
            $query->where('volcano_id', $request->volcano_id);
        }

        if ($request->filled('year')) {
            $query->whereYear('event_date', $request->year);
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('description', 'like', "%{$q}%")
                    ->orWhere('impact_summary', 'like', "%{$q}%")
                    ->orWhereHas('volcano', function ($vq) use ($q) {
                        $vq->where('name', 'like', "%{$q}%")
                            ->orWhere('province', 'like', "%{$q}%");
                    });
            });
        }

        $histories = $query->orderBy('event_date', 'desc')->paginate(10)->withQueryString();

        $volcanoes = Volcano::orderBy('name')->get();
        $years = DisasterHistory::all()
            ->map(fn($item) => $item->event_date ? $item->event_date->format('Y') : null)
            ->filter()
            ->unique()
            ->values();

        $totalEvents = DisasterHistory::count();
        $totalCasualties = DisasterHistory::sum('casualties_count');

        return view('disasters.index', compact(
            'histories',
            'volcanoes',
            'years',
            'totalEvents',
            'totalCasualties'
        ));
    }
}
