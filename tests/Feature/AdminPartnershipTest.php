<?php

namespace Tests\Feature;

use App\Models\CompanySetting;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPartnershipTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        CompanySetting::create(['key' => 'company_name', 'value' => 'Aljamas']);

        $this->admin = User::create([
            'name'     => 'Admin Aljamas',
            'email'    => 'admin@aljamas.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_partnerships(): void
    {
        $response = $this->get('/admin/partnerships');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_partnerships_list_and_status_tabs(): void
    {
        Partnership::create([
            'name'             => 'Budi Santoso',
            'email'            => 'budi@example.com',
            'phone'            => '08123456789',
            'company'          => 'Dimsum Berkah',
            'location'         => 'Jakarta Selatan',
            'partnership_type' => 'Distributor Resmi',
            'message'          => 'Mohon informasi pasokan rutin 100 pack per minggu.',
            'status'           => 'new',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/partnerships');

        $response->assertStatus(200);
        $response->assertSee('Daftar Pengajuan Kemitraan');
        $response->assertSee('Budi Santoso');
        $response->assertSee('Dimsum Berkah');
        $response->assertSee('Distributor Resmi');
    }

    public function test_admin_can_filter_partnerships_by_status(): void
    {
        Partnership::create([
            'name'             => 'Mitra Baru',
            'email'            => 'baru@example.com',
            'phone'            => '081111111',
            'location'         => 'Bandung',
            'partnership_type' => 'Reseller',
            'status'           => 'new',
        ]);

        Partnership::create([
            'name'             => 'Mitra Dihubungi',
            'email'            => 'kontak@example.com',
            'phone'            => '082222222',
            'location'         => 'Surabaya',
            'partnership_type' => 'Agen',
            'status'           => 'contacted',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/partnerships?status=new');
        $response->assertStatus(200);
        $response->assertSee('Mitra Baru');
        $response->assertDontSee('Mitra Dihubungi');
    }

    public function test_admin_can_view_partnership_detail_page(): void
    {
        $partnership = Partnership::create([
            'name'             => 'Siti Aminah',
            'email'            => 'siti@example.com',
            'phone'            => '08129876543',
            'company'          => 'Resto Rasa Enak',
            'location'         => 'Tangerang',
            'partnership_type' => 'Horeka / Restoran',
            'message'          => 'Ingin mencoba sampel kulit dimsum premium.',
            'status'           => 'new',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/partnerships/' . $partnership->id);

        $response->assertStatus(200);
        $response->assertSee('Detail Pengajuan Kemitraan');
        $response->assertSee('Siti Aminah');
        $response->assertSee('Resto Rasa Enak');
        $response->assertSee('Ingin mencoba sampel kulit dimsum premium.');
    }

    public function test_admin_can_update_partnership_status_and_notes(): void
    {
        $partnership = Partnership::create([
            'name'             => 'Joko Susilo',
            'email'            => 'joko@example.com',
            'phone'            => '081333333',
            'location'         => 'Yogyakarta',
            'partnership_type' => 'Distributor',
            'status'           => 'new',
        ]);

        $response = $this->actingAs($this->admin)->put('/admin/partnerships/' . $partnership->id, [
            'status'      => 'contacted',
            'admin_notes' => 'Sudah ditelepon, jadwal kirim sampel hari Kamis.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('partnerships', [
            'id'          => $partnership->id,
            'status'      => 'contacted',
            'admin_notes' => 'Sudah ditelepon, jadwal kirim sampel hari Kamis.',
        ]);
    }

    public function test_admin_can_delete_partnership(): void
    {
        $partnership = Partnership::create([
            'name'             => 'Data Hapus',
            'email'            => 'hapus@example.com',
            'phone'            => '081444444',
            'location'         => 'Semarang',
            'partnership_type' => 'Mitra Usaha',
            'status'           => 'rejected',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/partnerships/' . $partnership->id);

        $response->assertRedirect('/admin/partnerships');
        $this->assertDatabaseMissing('partnerships', [
            'id' => $partnership->id,
        ]);
    }
}
