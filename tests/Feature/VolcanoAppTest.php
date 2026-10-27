<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Volcano;
use App\Models\MissingPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VolcanoAppTest extends TestCase
{
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SI-Berapi');
        $response->assertSee('AWAS');
    }

    public function test_volcano_index_and_detail(): void
    {
        $response = $this->get('/gunung');
        $response->assertStatus(200);
        $response->assertSee('Gunung Merapi');

        $volcano = Volcano::first();
        if ($volcano) {
            $showResponse = $this->get('/gunung/' . $volcano->id);
            $showResponse->assertStatus(200);
            $showResponse->assertSee($volcano->name);
        }
    }

    public function test_missing_persons_page_and_public_submission(): void
    {
        $response = $this->get('/orang-hilang');
        $response->assertStatus(200);
        $response->assertSee('Papan Informasi Orang Hilang');

        $volcano = Volcano::first();

        $postResponse = $this->post('/orang-hilang', [
            'reporter_name' => 'Budi Relawan',
            'reporter_phone' => '081234567899',
            'victim_name' => 'Agus Wicaksono',
            'age' => 28,
            'gender' => 'Laki-laki',
            'volcano_id' => $volcano?->id,
            'last_seen_location' => 'Pos Pendakian 2',
            'last_seen_date' => '2024-10-10',
            'characteristics' => 'Jaket hitam, ransel oranye, tinggi 175cm',
            'notes' => 'Terpisah saat kabut tebal turun.',
        ]);

        $postResponse->assertRedirect('/orang-hilang');
        $this->assertDatabaseHas('missing_persons', [
            'victim_name' => 'Agus Wicaksono',
            'reporter_name' => 'Budi Relawan',
        ]);
    }

    public function test_education_page_is_accessible(): void
    {
        $response = $this->get('/edukasi');
        $response->assertStatus(200);
        $response->assertSee('Edukasi');
    }

    public function test_disaster_history_is_accessible(): void
    {
        $response = $this->get('/riwayat');
        $response->assertStatus(200);
        $response->assertSee('Riwayat Bencana Erupsi');
    }

    public function test_admin_authentication_and_dashboard(): void
    {
        $admin = User::where('email', 'admin@siberapi.id')->first();
        if (!$admin) {
            $admin = User::factory()->create([
                'email' => 'admin@siberapi.id',
                'password' => bcrypt('admin123')
            ]);
        }

        $loginResponse = $this->post('/login', [
            'email' => 'admin@siberapi.id',
            'password' => 'admin123',
        ]);

        $loginResponse->assertRedirect(route('admin.dashboard'));

        $dashResponse = $this->actingAs($admin)->get('/admin/dashboard');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Pusat Pengendali');
    }
}
