<?php

namespace App\Http\Controllers;

use App\Models\Volcano;
use App\Models\MissingPerson;
use App\Models\DisasterHistory;
use App\Models\EducationContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $statusCounts = [
            'Awas' => Volcano::where('status_level', 'Awas')->count(),
            'Siaga' => Volcano::where('status_level', 'Siaga')->count(),
            'Waspada' => Volcano::where('status_level', 'Waspada')->count(),
            'Normal' => Volcano::where('status_level', 'Normal')->count(),
        ];

        $priorityVolcanoes = Volcano::whereIn('status_level', ['Awas', 'Siaga'])
            ->orderByRaw("CASE WHEN status_level = 'Awas' THEN 1 WHEN status_level = 'Siaga' THEN 2 ELSE 3 END")
            ->take(6)
            ->get();

        $allVolcanoes = Volcano::select('id', 'name', 'province', 'height', 'status_level', 'latitude', 'longitude', 'safety_radius', 'image')
            ->get();

        $recentMissing = MissingPerson::with('volcano')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $recentHistories = DisasterHistory::with('volcano')
            ->orderBy('event_date', 'desc')
            ->take(3)
            ->get();

        $quickMitigation = EducationContent::where('category', 'mitigasi')
            ->first();

        return view('home', compact(
            'statusCounts',
            'priorityVolcanoes',
            'allVolcanoes',
            'recentMissing',
            'recentHistories',
            'quickMitigation'
        ));
    }
}
