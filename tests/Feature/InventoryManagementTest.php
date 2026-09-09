<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_is_accessible_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Tổng quan');
    }

    public function test_product_can_be_created(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Vật tư tiêu hao',
            'description' => 'Vật tư dùng trong bệnh viện',
        ]);
        $supplier = Supplier::create([
            'name' => 'Công ty Dược phẩm A',
            'contact_name' => 'Nguyễn Văn A',
            'phone' => '0909123456',
            'email' => 'support@duocphama.vn',
            'address' => 'Đà Nẵng',
        ]);

        $response = $this->actingAs($user)->post('/products', [
            'name' => 'Bông gạc y tế',
            'sku' => 'VT-001',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'unit' => 'Hộp',
            'purchase_price' => 150000,
            'selling_price' => 220000,
            'quantity' => 50,
            'reorder_level' => 15,
            'status' => 'active',
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['sku' => 'VT-001', 'name' => 'Bông gạc y tế']);
    }
}
