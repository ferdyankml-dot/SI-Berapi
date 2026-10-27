<?php

namespace App\Http\Controllers;

use App\Models\EducationContent;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->input('tab', 'definisi');

        $contents = EducationContent::all()->groupBy('category');

        $definisi = $contents->get('definisi', collect());
        $penyebab = $contents->get('penyebab', collect());
        $dampak = $contents->get('dampak', collect());
        $mitigasi = $contents->get('mitigasi', collect());

        $videos = EducationContent::whereNotNull('video_url')->get();

        return view('education.index', compact(
            'activeTab',
            'definisi',
            'penyebab',
            'dampak',
            'mitigasi',
            'videos'
        ));
    }
}
