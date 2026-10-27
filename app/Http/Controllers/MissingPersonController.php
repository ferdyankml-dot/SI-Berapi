<?php

namespace App\Http\Controllers;

use App\Models\MissingPerson;
use App\Models\Volcano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MissingPersonController extends Controller
{
    public function index(Request $request)
    {
        $query = MissingPerson::with('volcano')->where('is_approved', true);

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('victim_name', 'like', "%{$q}%")
                    ->orWhere('last_seen_location', 'like', "%{$q}%")
                    ->orWhere('characteristics', 'like', "%{$q}%");
            });
        }

        if ($request->filled('volcano_id')) {
            $query->where('volcano_id', $request->volcano_id);
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy('last_seen_date', 'asc');
        } else {
            $query->orderByRaw("CASE WHEN status = 'Dicari' THEN 1 ELSE 2 END")
                ->orderBy('created_at', 'desc');
        }

        $missingPersons = $query->paginate(8)->withQueryString();

        $volcanoes = Volcano::orderBy('name')->get();
        $totalSearching = MissingPerson::where('is_approved', true)->where('status', 'Dicari')->count();
        $totalFound = MissingPerson::where('is_approved', true)->where('status', 'Ditemukan')->count();

        return view('missing_persons.index', compact(
            'missingPersons',
            'volcanoes',
            'totalSearching',
            'totalFound'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reporter_name' => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:50',
            'victim_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'volcano_id' => 'nullable|exists:volcanoes,id',
            'last_seen_location' => 'required|string|max:255',
            'last_seen_date' => 'required|date',
            'characteristics' => 'required|string',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'reporter_name.required' => 'Nama pelapor wajib diisi.',
            'reporter_phone.required' => 'Nomor WhatsApp / HP pelapor wajib diisi.',
            'victim_name.required' => 'Nama korban hilang wajib diisi.',
            'age.required' => 'Usia korban wajib diisi.',
            'gender.required' => 'Pilih jenis kelamin korban.',
            'last_seen_location.required' => 'Lokasi terakhir dilihat wajib diisi.',
            'last_seen_date.required' => 'Tanggal terakhir dilihat wajib diisi.',
            'characteristics.required' => 'Ciri-ciri fisik dan pakaian terakhir wajib diisi.',
            'photo.image' => 'File foto harus berupa format gambar valid (JPG, PNG, WEBP).',
            'photo.max' => 'Ukuran foto maksimal adalah 3 MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke direktori temporary /tmp untuk menghindari read-only filesystem Vercel
            $targetPath = '/tmp/uploads/missing';
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $file->move($targetPath, $filename);
            $photoPath = '/uploads/missing/' . $filename;
        }

        MissingPerson::create([
            'reporter_name' => $validated['reporter_name'],
            'reporter_phone' => $validated['reporter_phone'],
            'victim_name' => $validated['victim_name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'volcano_id' => $validated['volcano_id'] ?? null,
            'last_seen_location' => $validated['last_seen_location'],
            'last_seen_date' => $validated['last_seen_date'],
            'characteristics' => $validated['characteristics'],
            'notes' => $validated['notes'] ?? null,
            'photo' => $photoPath,
            'status' => 'Dicari',
            'is_approved' => true,
        ]);

        return redirect()->route('missing_persons.index')
            ->with('flash_success', 'Laporan orang hilang berhasil dipublikasikan! Tim SAR dan relawan masyarakat telah dapat melihat data ini di papan informasi publik.');
    }
}