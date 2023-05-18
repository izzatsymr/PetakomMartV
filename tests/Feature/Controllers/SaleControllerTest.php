<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Sale;

use App\Models\PaymentMethod;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sales()
    {
        $sales = Sale::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales.index')
            ->assertViewHas('sales');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sale()
    {
        $response = $this->get(route('sales.create'));

        $response->assertOk()->assertViewIs('app.sales.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sale()
    {
        $data = Sale::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales.store'), $data);

        $this->assertDatabaseHas('sales', $data);

        $sale = Sale::latest('id')->first();

        $response->assertRedirect(route('sales.edit', $sale));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sales.show', $sale));

        $response
            ->assertOk()
            ->assertViewIs('app.sales.show')
            ->assertViewHas('sale');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sales.edit', $sale));

        $response
            ->assertOk()
            ->assertViewIs('app.sales.edit')
            ->assertViewHas('sale');
    }

    /**
     * @test
     */
    public function it_updates_the_sale()
    {
        $sale = Sale::factory()->create();

        $paymentMethod = PaymentMethod::factory()->create();
        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber,
            'payment_method_id' => $this->faker->randomNumber,
            'subtotal_sales' => $this->faker->randomNumber(2),
            'service_tax' => $this->faker->randomNumber(2),
            'total_sales' => $this->faker->randomNumber(2),
            'status' => 'completed',
            'refunded_reason' => $this->faker->text,
            'payment_method_id' => $paymentMethod->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('sales.update', $sale), $data);

        $data['id'] = $sale->id;

        $this->assertDatabaseHas('sales', $data);

        $response->assertRedirect(route('sales.edit', $sale));
    }

    /**
     * @test
     */
    public function it_deletes_the_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->delete(route('sales.destroy', $sale));

        $response->assertRedirect(route('sales.index'));

        $this->assertSoftDeleted($sale);
    }
}
