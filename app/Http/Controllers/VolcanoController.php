<?php

namespace App\Http\Controllers;

use App\Models\Volcano;
use Illuminate\Http\Request;

class VolcanoController extends Controller
{
    public function index(Request $request)
    {
        $query = Volcano::query();

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('province', 'like', "%{$q}%");
            });
        }

        if ($request->filled('province')) {
            $query->where('province', 'like', "%{$request->province}%");
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status_level', $request->status);
        }

        $sort = $request->input('sort', 'status');
        if ($sort === 'height_desc') {
            $query->orderBy('height', 'desc');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderByRaw("CASE 
                WHEN status_level = 'Awas' THEN 1 
                WHEN status_level = 'Siaga' THEN 2 
                WHEN status_level = 'Waspada' THEN 3 
                ELSE 4 END");
        }

        $volcanoes = $query->paginate(9)->withQueryString();

        $allVolcanoes = Volcano::select('id', 'name', 'location', 'province', 'height', 'status_level', 'latitude', 'longitude', 'safety_radius', 'image')
            ->get();

        $provinces = Volcano::select('province')->distinct()->orderBy('province')->pluck('province');

        return view('volcanoes.index', compact('volcanoes', 'allVolcanoes', 'provinces'));
    }

    public function show($id)
    {
        $volcano = Volcano::with(['disasterHistories', 'missingPersons' => function ($q) {
            $q->where('is_approved', true)->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        $nearbyVolcanoes = Volcano::where('id', '!=', $id)
            ->where('province', $volcano->province)
            ->take(3)
            ->get();

        return view('volcanoes.show', compact('volcano', 'nearbyVolcanoes'));
    }
}
