<?php

namespace Tests\Feature;

use App\Models\CompanySetting;
use App\Models\Partnership;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPartnershipTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CompanySetting::create([
            'key' => 'company_name',
            'value' => 'Aljamas',
        ]);
        CompanySetting::create([
            'key' => 'whatsapp_number',
            'value' => '6281234567890',
        ]);
        CompanySetting::create([
            'key' => 'company_email',
            'value' => 'info@aljamas.com',
        ]);
    }

    public function test_kemitraan_page_renders_successfully(): void
    {
        $response = $this->get('/kemitraan');

        $response->assertStatus(200);
        $response->assertSee('Bangun Peluang Bisnis Bersama Aljamas');
        $response->assertSee('Kenapa Bermitra dengan Aljamas?');
        $response->assertSee('Siapa yang Cocok Menjadi Mitra?');
        $response->assertSee('Langkah Mudah Menjadi Mitra');
        $response->assertSee('Ajukan Kemitraan Sekarang');
        $response->assertSee('Siap Mengembangkan Bisnis Bersama Aljamas?');
    }

    public function test_kemitraan_form_validation_required_fields(): void
    {
        $response = $this->post('/kemitraan', []);

        $response->assertSessionHasErrors(['name', 'email', 'phone', 'location', 'partnership_type']);
        $this->assertDatabaseCount('partnerships', 0);
    }

    public function test_kemitraan_form_validation_invalid_email(): void
    {
        $response = $this->post('/kemitraan', [
            'name' => 'Budi Santoso',
            'email' => 'budi-invalid-email',
            'phone' => '081234567890',
            'location' => 'Surabaya',
            'partnership_type' => 'Distributor / Agen Pangan',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('partnerships', 0);
    }

    public function test_kemitraan_form_submission_success(): void
    {
        $response = $this->post('/kemitraan', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'company' => 'PT Kuliner Jaya',
            'location' => 'Surabaya, Jawa Timur',
            'partnership_type' => 'Distributor / Agen Pangan',
            'message' => 'Saya tertarik menjadi distributor untuk area Surabaya Barat.',
        ]);

        $response->assertRedirect('/kemitraan#form-kemitraan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('partnerships', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'company' => 'PT Kuliner Jaya',
            'location' => 'Surabaya, Jawa Timur',
            'partnership_type' => 'Distributor / Agen Pangan',
            'message' => 'Saya tertarik menjadi distributor untuk area Surabaya Barat.',
            'status' => 'new',
        ]);
    }
}
