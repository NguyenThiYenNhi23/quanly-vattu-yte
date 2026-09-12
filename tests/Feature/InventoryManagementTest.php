<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Customer;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
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

    public function test_product_schema_does_not_include_price_columns(): void
    {
        $this->assertFalse(Schema::hasColumn('products', 'purchase_price'));
        $this->assertFalse(Schema::hasColumn('products', 'selling_price'));
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
            'category_id' => $category->id,
        ]);

        $response->assertRedirect('/products');
        $product = Product::where('name', 'Bông gạc y tế')->first();
        $this->assertNotNull($product);
        $this->assertNotNull($product->sku);
        $this->assertSame($category->id, $product->category_id);
    }

    public function test_import_and_export_transactions_store_supplier_and_customer_and_show_detail(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Thiết bị y tế',
            'description' => 'Các thiết bị y tế',
        ]);
        $supplier = Supplier::create([
            'name' => 'Công ty Dược phẩm Hòa Bình',
            'contact_name' => 'Trần Văn Hùng',
            'phone' => '0911222333',
            'email' => 'hoaibinh@med.vn',
            'address' => 'Hà Nội',
        ]);
        $customer = Customer::create([
            'name' => 'Bệnh viện Đa khoa Đà Nẵng',
            'phone' => '0909777666',
            'email' => 'bvdkdn@example.com',
            'address' => 'Đà Nẵng',
            'notes' => 'Khách hàng lớn',
        ]);
        $product = Product::create([
            'name' => 'Máy đo nhịp tim',
            'sku' => 'VT-010',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'unit' => 'Cái',
            'quantity' => 10,
            'reorder_level' => 2,
            'status' => 'active',
        ]);

        $importResponse = $this->actingAs($user)->post('/transactions/import', [
            'product_id' => $product->id,
            'quantity' => 5,
            'unit_price' => 2500000,
            'supplier_id' => $supplier->id,
            'reference' => 'NK-001',
            'notes' => 'Nhập bổ sung hàng tháng',
        ]);

        $importResponse->assertRedirect('/transactions');
        $this->assertDatabaseHas('inventory_transactions', [
            'product_id' => $product->id,
            'type' => 'import',
            'supplier_id' => $supplier->id,
        ]);
        $this->assertDatabaseHas('inventory_transactions', [
            'reference' => 'NK-000001',
        ]);

        $exportResponse = $this->actingAs($user)->post('/transactions/export', [
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_price' => 3200000,
            'customer_id' => $customer->id,
            'reference' => 'XK-001',
            'notes' => 'Xuất cho bệnh viện',
        ]);

        $exportResponse->assertRedirect('/transactions');
        $this->assertDatabaseHas('inventory_transactions', [
            'product_id' => $product->id,
            'type' => 'export',
            'customer_id' => $customer->id,
        ]);
        $this->assertDatabaseHas('inventory_transactions', [
            'reference' => 'XK-000001',
        ]);

        $transaction = InventoryTransaction::where('type', 'import')->firstOrFail();
        $detailResponse = $this->actingAs($user)->get('/transactions/' . $transaction->id);

        $detailResponse->assertOk();
        $detailResponse->assertSee('Chi tiết phiếu nhập');
        $detailResponse->assertSee('Công ty Dược phẩm Hòa Bình');
    }

    public function test_product_and_category_cannot_be_deleted_after_transaction_exists(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Máy móc y tế',
            'description' => 'Máy móc dùng trong bệnh viện',
        ]);
        $product = Product::create([
            'name' => 'Máy đo huyết áp',
            'sku' => 'VT-100',
            'category_id' => $category->id,
            'unit' => 'Cái',
            'quantity' => 10,
            'reorder_level' => 2,
            'status' => 'active',
        ]);

        InventoryTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => null,
            'customer_id' => null,
            'type' => 'import',
            'quantity' => 10,
            'unit_price' => 0,
            'notes' => 'Nhập ban đầu',
            'reference' => 'NK-000001',
            'performed_by' => $user->name,
        ]);

        $deleteProductResponse = $this->actingAs($user)->delete('/products/' . $product->id);
        $deleteProductResponse->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['id' => $product->id]);

        $deleteCategoryResponse = $this->actingAs($user)->delete('/categories/' . $category->id);
        $deleteCategoryResponse->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_import_and_export_views_are_separate_routes(): void
    {
        $user = User::factory()->create();

        $importResponse = $this->actingAs($user)->get('/transactions/import');
        $importResponse->assertOk();
        $importResponse->assertSee('Tạo phiếu nhập kho');

        $exportResponse = $this->actingAs($user)->get('/transactions/export');
        $exportResponse->assertOk();
        $exportResponse->assertSee('Tạo phiếu xuất kho');
    }

    public function test_creating_product_does_not_create_inventory_transaction_automatically(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Dụng cụ bệnh viện',
            'description' => 'Dụng cụ y tế cơ bản',
        ]);
        $supplier = Supplier::create([
            'name' => 'Nhà cung cấp A',
            'contact_name' => 'Nguyễn Văn A',
            'phone' => '0912345678',
            'email' => 'a@example.com',
            'address' => 'Hà Nội',
        ]);

        $this->actingAs($user)->post('/products', [
            'name' => 'Găng tay y tế',
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseCount('inventory_transactions', 0);
    }

    public function test_import_and_export_generate_automatic_document_codes_without_reference(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Dụng cụ y tế',
            'description' => 'Dụng cụ cơ bản',
        ]);
        $supplier = Supplier::create([
            'name' => 'Nhà cung cấp B',
            'contact_name' => 'Lê Văn B',
            'phone' => '0909888777',
            'email' => 'b@example.com',
            'address' => 'TP.HCM',
        ]);
        $customer = Customer::create([
            'name' => 'Bệnh viện B',
            'phone' => '0909555444',
            'email' => 'bvb@example.com',
            'address' => 'TP.HCM',
            'notes' => 'Khách hàng',
        ]);
        $product = Product::create([
            'name' => 'Băng keo y tế',
            'sku' => 'SP-000001',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'unit' => 'Cuộn',
            'quantity' => 20,
            'reorder_level' => 5,
            'status' => 'active',
        ]);

        $importResponse = $this->actingAs($user)->post('/transactions/import', [
            'product_id' => $product->id,
            'quantity' => 3,
            'supplier_id' => $supplier->id,
            'notes' => 'Nhập bổ sung',
        ]);

        $importResponse->assertRedirect('/transactions');
        $this->assertDatabaseHas('inventory_transactions', [
            'product_id' => $product->id,
            'type' => 'import',
            'supplier_id' => $supplier->id,
        ]);
        $this->assertDatabaseHas('inventory_transactions', [
            'reference' => 'NK-000001',
        ]);

        $exportResponse = $this->actingAs($user)->post('/transactions/export', [
            'product_id' => $product->id,
            'quantity' => 1,
            'customer_id' => $customer->id,
            'notes' => 'Xuất cho bệnh viện',
        ]);

        $exportResponse->assertRedirect('/transactions');
        $this->assertDatabaseHas('inventory_transactions', [
            'product_id' => $product->id,
            'type' => 'export',
            'customer_id' => $customer->id,
        ]);
        $this->assertDatabaseHas('inventory_transactions', [
            'reference' => 'XK-000001',
        ]);
    }
}
