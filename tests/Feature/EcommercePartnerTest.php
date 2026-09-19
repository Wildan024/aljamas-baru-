<?php

namespace Tests\Feature;

use App\Models\CompanySetting;
use App\Models\EcommercePartner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EcommercePartnerTest extends TestCase
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

    /**
     * 1. Admin can create an e-commerce partner.
     */
    public function test_admin_can_create_an_ecommerce_partner(): void
    {
        Storage::fake('public');

        $logo = UploadedFile::fake()->create('shopee_logo.png', 100, 'image/png');

        $response = $this->actingAs($this->admin)->post('/admin/ecommerce-partners', [
            'name'       => 'Shopee Aljamas Official',
            'url'        => 'https://shopee.co.id/aljamas-official',
            'logo'       => $logo,
            'sort_order' => 1,
            'is_active'  => 1,
        ]);

        $response->assertRedirect('/admin/ecommerce-partners');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ecommerce_partners', [
            'name'       => 'Shopee Aljamas Official',
            'slug'       => 'shopee-aljamas-official',
            'url'        => 'https://shopee.co.id/aljamas-official',
            'sort_order' => 1,
            'is_active'  => 1,
        ]);

        $partner = EcommercePartner::where('slug', 'shopee-aljamas-official')->first();
        $this->assertNotNull($partner->logo);
        Storage::disk('public')->assertExists($partner->logo);
    }

    /**
     * 2. Admin can edit an e-commerce partner.
     */
    public function test_admin_can_edit_an_ecommerce_partner(): void
    {
        $partner = EcommercePartner::create([
            'name'       => 'Tokopedia Store',
            'url'        => 'https://tokopedia.com/toko-aljamas',
            'sort_order' => 2,
            'is_active'  => true,
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/ecommerce-partners/{$partner->id}", [
            'name'       => 'Tokopedia Aljamas Prima',
            'url'        => 'https://tokopedia.com/aljamas-prima',
            'sort_order' => 5,
            'is_active'  => 1,
        ]);

        $response->assertRedirect('/admin/ecommerce-partners');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ecommerce_partners', [
            'id'         => $partner->id,
            'name'       => 'Tokopedia Aljamas Prima',
            'url'        => 'https://tokopedia.com/aljamas-prima',
            'sort_order' => 5,
        ]);
    }

    /**
     * 3. Admin can delete an e-commerce partner.
     */
    public function test_admin_can_delete_an_ecommerce_partner(): void
    {
        Storage::fake('public');
        $logoPath = UploadedFile::fake()->create('temp_logo.png', 50, 'image/png')->store('ecommerce_partners', 'public');

        $partner = EcommercePartner::create([
            'name'       => 'Lazada Aljamas',
            'url'        => 'https://lazada.co.id/aljamas',
            'logo'       => $logoPath,
            'sort_order' => 3,
            'is_active'  => true,
        ]);

        Storage::disk('public')->assertExists($logoPath);

        $response = $this->actingAs($this->admin)->delete("/admin/ecommerce-partners/{$partner->id}");

        $response->assertRedirect('/admin/ecommerce-partners');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('ecommerce_partners', ['id' => $partner->id]);
        Storage::disk('public')->assertMissing($logoPath);
    }

    /**
     * 4. Admin can activate/deactivate a partner.
     */
    public function test_admin_can_activate_and_deactivate_a_partner(): void
    {
        $partner = EcommercePartner::create([
            'name'       => 'TikTok Shop',
            'url'        => 'https://www.tiktok.com/@aljamas',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        // Toggle from true to false
        $response = $this->actingAs($this->admin)->patch("/admin/ecommerce-partners/{$partner->id}/toggle");
        $response->assertRedirect();
        $this->assertDatabaseHas('ecommerce_partners', [
            'id'        => $partner->id,
            'is_active' => false,
        ]);

        // Toggle back from false to true
        $response2 = $this->actingAs($this->admin)->patch("/admin/ecommerce-partners/{$partner->id}/toggle");
        $response2->assertRedirect();
        $this->assertDatabaseHas('ecommerce_partners', [
            'id'        => $partner->id,
            'is_active' => true,
        ]);
    }

    /**
     * 5. Multiple partners can exist simultaneously.
     */
    public function test_multiple_partners_can_exist_simultaneously(): void
    {
        EcommercePartner::create([
            'name'       => 'Partner Shopee',
            'url'        => 'https://shopee.co.id/aljamas',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        EcommercePartner::create([
            'name'       => 'Partner Tokopedia',
            'url'        => 'https://tokopedia.com/aljamas',
            'sort_order' => 2,
            'is_active'  => true,
        ]);

        EcommercePartner::create([
            'name'       => 'Partner TikTok Shop',
            'url'        => 'https://tiktok.com/@aljamas',
            'sort_order' => 3,
            'is_active'  => true,
        ]);

        $this->assertCount(3, EcommercePartner::all());
    }

    /**
     * 6. Homepage displays multiple active partners.
     */
    public function test_homepage_displays_multiple_active_partners(): void
    {
        EcommercePartner::create([
            'name'       => 'Shopee Store',
            'url'        => 'https://shopee.co.id/aljamas',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        EcommercePartner::create([
            'name'       => 'Tokopedia Store',
            'url'        => 'https://tokopedia.com/aljamas',
            'sort_order' => 2,
            'is_active'  => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('E-Commerce Partner');
        $response->assertSee('Shopee Store');
        $response->assertSee('Tokopedia Store');
    }

    /**
     * 7. Inactive partners do not appear on homepage.
     */
    public function test_inactive_partners_do_not_appear_on_homepage(): void
    {
        EcommercePartner::create([
            'name'       => 'Active Shopee',
            'url'        => 'https://shopee.co.id/active',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        EcommercePartner::create([
            'name'       => 'Hidden Blibli',
            'url'        => 'https://blibli.com/hidden',
            'sort_order' => 2,
            'is_active'  => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Active Shopee');
        $response->assertDontSee('Hidden Blibli');
    }

    /**
     * 8. Partners follow sort_order.
     */
    public function test_partners_follow_sort_order(): void
    {
        $partnerB = EcommercePartner::create([
            'name'       => 'Partner Second',
            'url'        => 'https://second.com',
            'sort_order' => 20,
            'is_active'  => true,
        ]);

        $partnerA = EcommercePartner::create([
            'name'       => 'Partner First',
            'url'        => 'https://first.com',
            'sort_order' => 5,
            'is_active'  => true,
        ]);

        $ordered = EcommercePartner::active()->ordered()->get();

        $this->assertEquals($partnerA->id, $ordered->first()->id);
        $this->assertEquals($partnerB->id, $ordered->last()->id);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeInOrder(['Partner First', 'Partner Second']);
    }

    /**
     * 9. Each partner points to its own URL.
     */
    public function test_each_partner_points_to_its_own_url(): void
    {
        EcommercePartner::create([
            'name'       => 'Shopee Mall',
            'url'        => 'https://shopee.co.id/unique-shopee-link',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        EcommercePartner::create([
            'name'       => 'Tokopedia Official',
            'url'        => 'https://tokopedia.com/unique-tokopedia-link',
            'sort_order' => 2,
            'is_active'  => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('https://shopee.co.id/unique-shopee-link');
        $response->assertSee('https://tokopedia.com/unique-tokopedia-link');
    }

    /**
     * 10. Unauthenticated users cannot access admin partner management.
     */
    public function test_unauthenticated_users_cannot_access_admin_partner_management(): void
    {
        $this->get('/admin/ecommerce-partners')->assertRedirect('/login');
        $this->get('/admin/ecommerce-partners/create')->assertRedirect('/login');
        $this->post('/admin/ecommerce-partners', [])->assertRedirect('/login');
        $this->get('/admin/ecommerce-partners/1/edit')->assertRedirect('/login');
        $this->put('/admin/ecommerce-partners/1', [])->assertRedirect('/login');
        $this->delete('/admin/ecommerce-partners/1')->assertRedirect('/login');
        $this->patch('/admin/ecommerce-partners/1/toggle')->assertRedirect('/login');
    }

    /**
     * 11. Invalid URLs are rejected.
     */
    public function test_invalid_urls_are_rejected(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/ecommerce-partners', [
            'name'       => 'Invalid Partner Store',
            'url'        => 'not-a-valid-url',
            'sort_order' => 1,
            'is_active'  => 1,
        ]);

        $response->assertSessionHasErrors(['url']);
        $this->assertDatabaseMissing('ecommerce_partners', ['name' => 'Invalid Partner Store']);
    }

    /**
     * 12. Homepage remains functional when there are zero active partners.
     */
    public function test_homepage_remains_functional_when_there_are_zero_active_partners(): void
    {
        EcommercePartner::query()->delete();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('E-Commerce Partner');
        $response->assertSee('Kanal e-commerce sedang dipersiapkan');
    }
}
