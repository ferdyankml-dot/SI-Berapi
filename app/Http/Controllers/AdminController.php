<?php

namespace App\Http\Controllers;

use App\Models\Volcano;
use App\Models\MissingPerson;
use App\Models\DisasterHistory;
use App\Models\EducationContent;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Overview
    public function dashboard()
    {
        $stats = [
            'total_volcanoes' => Volcano::count(),
            'awas_count' => Volcano::where('status_level', 'Awas')->count(),
            'siaga_count' => Volcano::where('status_level', 'Siaga')->count(),
            'waspada_count' => Volcano::where('status_level', 'Waspada')->count(),
            'normal_count' => Volcano::where('status_level', 'Normal')->count(),
            'missing_searching' => MissingPerson::where('status', 'Dicari')->count(),
            'missing_found' => MissingPerson::where('status', 'Ditemukan')->count(),
            'total_histories' => DisasterHistory::count(),
            'total_education' => EducationContent::count(),
        ];

        $recentMissing = MissingPerson::with('volcano')->latest()->take(5)->get();
        $criticalVolcanoes = Volcano::whereIn('status_level', ['Awas', 'Siaga'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMissing', 'criticalVolcanoes'));
    }

    // ==========================================
    // 1. VOLCANO MANAGEMENT (CRUD)
    // ==========================================
    public function volcanoesIndex(Request $request)
    {
        $query = Volcano::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('name', 'like', "%{$q}%")
                ->orWhere('province', 'like', "%{$q}%");
        }
        $volcanoes = $query->orderBy('name')->paginate(10)->withQueryString();
        return view('admin.volcanoes.index', compact('volcanoes'));
    }

    public function volcanoesCreate()
    {
        return view('admin.volcanoes.create');
    }

    public function volcanoesStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'height' => 'required|integer|min:0',
            'status_level' => 'required|in:Normal,Waspada,Siaga,Awas',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'safety_radius' => 'required|string|max:50',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ]);

        Volcano::create($validated);

        return redirect()->route('admin.volcanoes.index')
            ->with('flash_success', 'Data gunung ' . $validated['name'] . ' berhasil ditambahkan!');
    }

    public function volcanoesEdit($id)
    {
        $volcano = Volcano::findOrFail($id);
        return view('admin.volcanoes.edit', compact('volcano'));
    }

    public function volcanoesUpdate(Request $request, $id)
    {
        $volcano = Volcano::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'height' => 'required|integer|min:0',
            'status_level' => 'required|in:Normal,Waspada,Siaga,Awas',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'safety_radius' => 'required|string|max:50',
            'description' => 'required|string',
            'image' => 'nullable|url',
        ]);

        $volcano->update($validated);

        return redirect()->route('admin.volcanoes.index')
            ->with('flash_success', 'Data gunung ' . $volcano->name . ' berhasil diperbarui!');
    }

    public function volcanoesDestroy($id)
    {
        $volcano = Volcano::findOrFail($id);
        $name = $volcano->name;
        $volcano->delete();

        return redirect()->route('admin.volcanoes.index')
            ->with('flash_success', 'Gunung ' . $name . ' berhasil dihapus dari sistem.');
    }

    // ==========================================
    // 2. MISSING PERSON MODERATION
    // ==========================================
    public function missingIndex(Request $request)
    {
        $query = MissingPerson::with('volcano');
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('victim_name', 'like', "%{$q}%")
                ->orWhere('reporter_name', 'like', "%{$q}%");
        }
        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(10)->withQueryString();
        return view('admin.missing.index', compact('reports'));
    }

    public function missingToggleStatus($id)
    {
        $report = MissingPerson::findOrFail($id);
        $report->status = $report->status === 'Dicari' ? 'Ditemukan' : 'Dicari';
        $report->save();

        return back()->with('flash_success', "Status korban {$report->victim_name} diubah menjadi '{$report->status}'.");
    }

    public function missingToggleApproval($id)
    {
        $report = MissingPerson::findOrFail($id);
        $report->is_approved = !$report->is_approved;
        $report->save();

        $statusText = $report->is_approved ? 'Disetujui untuk Tampil' : 'Disembunyikan dari Publik';
        return back()->with('flash_success', "Laporan {$report->victim_name} kini {$statusText}.");
    }

    public function missingDestroy($id)
    {
        $report = MissingPerson::findOrFail($id);
        $name = $report->victim_name;
        $report->delete();

        return back()->with('flash_success', "Laporan orang hilang atas nama {$name} telah dihapus.");
    }

    // ==========================================
    // 3. DISASTER HISTORIES CRUD
    // ==========================================
    public function historyIndex()
    {
        $histories = DisasterHistory::with('volcano')->orderBy('event_date', 'desc')->paginate(10);
        return view('admin.histories.index', compact('histories'));
    }

    public function historyCreate()
    {
        $volcanoes = Volcano::orderBy('name')->get();
        return view('admin.histories.create', compact('volcanoes'));
    }

    public function historyStore(Request $request)
    {
        $validated = $request->validate([
            'volcano_id' => 'required|exists:volcanoes,id',
            'event_date' => 'required|date',
            'description' => 'required|string',
            'impact_summary' => 'required|string',
            'casualties_count' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        DisasterHistory::create($validated);

        return redirect()->route('admin.histories.index')
            ->with('flash_success', 'Catatan riwayat bencana baru berhasil ditambahkan!');
    }

    public function historyEdit($id)
    {
        $history = DisasterHistory::findOrFail($id);
        $volcanoes = Volcano::orderBy('name')->get();
        return view('admin.histories.edit', compact('history', 'volcanoes'));
    }

    public function historyUpdate(Request $request, $id)
    {
        $history = DisasterHistory::findOrFail($id);
        $validated = $request->validate([
            'volcano_id' => 'required|exists:volcanoes,id',
            'event_date' => 'required|date',
            'description' => 'required|string',
            'impact_summary' => 'required|string',
            'casualties_count' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        $history->update($validated);

        return redirect()->route('admin.histories.index')
            ->with('flash_success', 'Catatan riwayat bencana berhasil diperbarui!');
    }

    public function historyDestroy($id)
    {
        $history = DisasterHistory::findOrFail($id);
        $history->delete();

        return redirect()->route('admin.histories.index')
            ->with('flash_success', 'Catatan riwayat bencana berhasil dihapus.');
    }

    // ==========================================
    // 4. EDUCATION CONTENT CRUD
    // ==========================================
    public function educationIndex()
    {
        $educations = EducationContent::latest()->paginate(10);
        return view('admin.education.index', compact('educations'));
    }

    public function educationCreate()
    {
        return view('admin.education.create');
    }

    public function educationStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:definisi,penyebab,dampak,mitigasi',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'thumbnail' => 'nullable|url',
        ]);

        EducationContent::create($validated);

        return redirect()->route('admin.education.index')
            ->with('flash_success', 'Materi edukasi baru berhasil diterbitkan!');
    }

    public function educationEdit($id)
    {
        $education = EducationContent::findOrFail($id);
        return view('admin.education.edit', compact('education'));
    }

    public function educationUpdate(Request $request, $id)
    {
        $education = EducationContent::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:definisi,penyebab,dampak,mitigasi',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'thumbnail' => 'nullable|url',
        ]);

        $education->update($validated);

        return redirect()->route('admin.education.index')
            ->with('flash_success', 'Materi edukasi berhasil diperbarui!');
    }

    public function educationDestroy($id)
    {
        $education = EducationContent::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('flash_success', 'Materi edukasi berhasil dihapus.');
    }
}
