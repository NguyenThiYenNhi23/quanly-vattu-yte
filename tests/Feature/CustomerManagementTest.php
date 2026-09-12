<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_customer(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('customers.store'), [
            'name' => 'Nguyễn Thị Minh Anh',
            'phone' => '0901234567',
            'email' => 'minhanh@example.com',
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            'notes' => 'Ưu tiên liên hệ giờ hành chính.',
        ]);

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', [
            'name' => 'Nguyễn Thị Minh Anh',
            'phone' => '0901234567',
            'email' => 'minhanh@example.com',
        ]);
    }

    public function test_customer_name_and_phone_are_required_when_creating_a_customer(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from(route('customers.create'))->post(route('customers.store'), []);

        $response->assertRedirect(route('customers.create'));
        $response->assertSessionHasErrors(['name', 'phone']);
        $this->assertDatabaseCount('customers', 0);
    }

    public function test_customer_directory_can_be_searched_by_name_or_phone(): void
    {
        $user = User::factory()->create();
        Customer::create(['name' => 'Trần Bảo Ngọc', 'phone' => '0987654321']);
        Customer::create(['name' => 'Lê Quốc Huy', 'phone' => '0911222333']);

        $response = $this->actingAs($user)->get(route('customers.index', ['search' => '0987654321']));

        $response->assertSee('Trần Bảo Ngọc');
        $response->assertDontSee('Lê Quốc Huy');
    }

    public function test_unauthenticated_user_is_redirected_to_login_for_customer_directory(): void
    {
        $response = $this->get(route('customers.index'));

        $response->assertRedirect(route('login'));
    }
}
