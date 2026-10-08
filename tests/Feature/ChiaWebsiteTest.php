<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Promo;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChiaWebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_load_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Chia');

        $response = $this->get('/produk');
        $response->assertStatus(200);
        $response->assertSee('Katalog Produk');

        $response = $this->get('/tentang-kami');
        $response->assertStatus(200);
        $response->assertSee('Tentang Amidyas Superfood');

        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Hubungi Kami');
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::where('is_active', true)->first();
        $this->assertNotNull($product);

        $response = $this->get('/produk/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Administrator');
    }

    public function test_admin_can_view_products_management(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Kelola Katalog Produk');
    }

    public function test_admin_can_create_update_and_delete_product(): void
    {
        Storage::fake('public');
        $admin = User::first();
        $category = Category::first();

        // Create
        $response = $this->actingAs($admin)->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'Organic Chia Seed Test 100g',
            'price' => 25000,
            'summary' => 'Test summary',
            'description' => 'Test full description of chia seed.',
            'image' => UploadedFile::fake()->image('test_product.jpg'),
            'is_featured' => 1,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'Organic Chia Seed Test 100g']);

        $product = Product::where('name', 'Organic Chia Seed Test 100g')->first();

        // Update
        $response = $this->actingAs($admin)->put('/admin/products/' . $product->id, [
            'category_id' => $category->id,
            'name' => 'Organic Chia Seed Test 100g Updated',
            'price' => 30000,
            'summary' => 'Updated summary',
            'description' => 'Updated description.',
            'is_featured' => 0,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'Organic Chia Seed Test 100g Updated']);

        // Delete
        $response = $this->actingAs($admin)->delete('/admin/products/' . $product->id);
        $response->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_admin_can_create_and_manage_categories(): void
    {
        $admin = User::first();

        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Organic Drink Mix',
            'description' => 'Campuran minuman organik.',
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Organic Drink Mix']);

        $category = Category::where('name', 'Organic Drink Mix')->first();

        $response = $this->actingAs($admin)->put('/admin/categories/' . $category->id, [
            'name' => 'Organic Drink Mix Updated',
            'description' => 'Updated description',
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Organic Drink Mix Updated']);

        $response = $this->actingAs($admin)->delete('/admin/categories/' . $category->id);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_can_update_company_profile_and_contacts(): void
    {
        $admin = User::first();

        $response = $this->actingAs($admin)->put('/admin/company-profile', [
            'company_name' => 'Chia by Amidyas Superfood Official',
            'tagline' => 'Tagline Sehat Alami',
            'short_description' => 'Short description test',
            'about_us' => 'Long about us test description',
            'vision' => 'Visi test',
            'mission' => 'Misi test',
        ]);

        $response->assertRedirect('/admin/company-profile');
        $this->assertDatabaseHas('company_profiles', ['company_name' => 'Chia by Amidyas Superfood Official']);

        $response = $this->actingAs($admin)->put('/admin/contact', [
            'address' => 'Jl. Uji Coba No. 1, Jakarta',
            'phone' => '+62 812-3456-7890',
            'whatsapp' => '081234567890',
            'email' => 'cs@amidyassuperfood.com',
        ]);

        $response->assertRedirect('/admin/contact');
        $this->assertDatabaseHas('contacts', ['email' => 'cs@amidyassuperfood.com']);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->delete('/admin/users/' . $admin->id);
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_public_contact_form_redirects_to_whatsapp(): void
    {
        $response = $this->post('/kontak/kirim-pesan', [
            'name' => 'Budi',
            'phone' => '081234567890',
            'email' => 'budi@test.com',
            'subject' => 'Pemesanan',
            'message' => 'Halo saya ingin beli 2 bungkus.',
        ]);

        $response->assertStatus(302);
        $this->assertStringContainsString('wa.me', $response->headers->get('Location'));
    }
}
