<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $emergencyContacts = [
            [
                'agency' => 'Pusat Vulkanologi & Mitigasi Bencana Geologi (PVMBG)',
                'phone' => '(022) 7272606',
                'wa' => '081222223456',
                'desc' => 'Pemantauan aktivitas magma, peresmian level status gunung api & rekomendasi radius bahaya.',
                'icon' => 'activity',
                'badge' => 'Pemantauan Utama',
            ],
            [
                'agency' => 'Badan Nasional Penanggulangan Bencana (BNPB)',
                'phone' => '117 / (021) 51010112',
                'wa' => '081112114117',
                'desc' => 'Komando tanggap darurat nasional, logistik pengungsian, dan pengerahan personel SAR.',
                'icon' => 'shield-alert',
                'badge' => 'Pusat Krisis',
            ],
            [
                'agency' => 'Badan SAR Nasional (BASARNAS)',
                'phone' => '115 / (021) 65867510',
                'wa' => '08119999115',
                'desc' => 'Operasi pencarian dan pertolongan korban bencana alam dan pendaki hilang di gunung.',
                'icon' => 'life-buoy',
                'badge' => 'Search & Rescue',
            ],
            [
                'agency' => 'Kepolisian Negara Republik Indonesia (POLRI)',
                'phone' => '110',
                'wa' => null,
                'desc' => 'Pengamanan kawasan bencana, blokade zona merah berbahaya, dan identifikasi DVI korban.',
                'icon' => 'shield',
                'badge' => 'Keamanan',
            ],
            [
                'agency' => 'Layanan Ambulans & Kemenkes RI (SPGDT)',
                'phone' => '119',
                'wa' => null,
                'desc' => 'Pertolongan pertama medis gawat darurat dan rujukan rumah sakit lapangan bencana.',
                'icon' => 'heart-pulse',
                'badge' => 'Medis Darurat',
            ],
            [
                'agency' => 'Palang Merah Indonesia (PMI)',
                'phone' => '(021) 7992325',
                'wa' => '08119799232',
                'desc' => 'Dukungan dapur umum, kantong darah, tenda pengungsian, dan pertolongan pertama relawan.',
                'icon' => 'cross',
                'badge' => 'Kemanusiaan',
            ],
        ];

        return view('contact.index', compact('emergencyContacts'));
    }
}
