<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Inventory;

use App\Models\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_inventories()
    {
        $inventories = Inventory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('inventories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.inventories.index')
            ->assertViewHas('inventories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_inventory()
    {
        $response = $this->get(route('inventories.create'));

        $response->assertOk()->assertViewIs('app.inventories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_inventory()
    {
        $data = Inventory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('inventories.store'), $data);

        $this->assertDatabaseHas('inventories', $data);

        $inventory = Inventory::latest('id')->first();

        $response->assertRedirect(route('inventories.edit', $inventory));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_inventory()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventories.show', $inventory));

        $response
            ->assertOk()
            ->assertViewIs('app.inventories.show')
            ->assertViewHas('inventory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_inventory()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventories.edit', $inventory));

        $response
            ->assertOk()
            ->assertViewIs('app.inventories.edit')
            ->assertViewHas('inventory');
    }

    /**
     * @test
     */
    public function it_updates_the_inventory()
    {
        $inventory = Inventory::factory()->create();

        $product = Product::factory()->create();

        $data = [
            'product_id' => $this->faker->randomNumber,
            'stock_quantity' => $this->faker->randomNumber,
            'product_id' => $product->id,
        ];

        $response = $this->put(route('inventories.update', $inventory), $data);

        $data['id'] = $inventory->id;

        $this->assertDatabaseHas('inventories', $data);

        $response->assertRedirect(route('inventories.edit', $inventory));
    }

    /**
     * @test
     */
    public function it_deletes_the_inventory()
    {
        $inventory = Inventory::factory()->create();

        $response = $this->delete(route('inventories.destroy', $inventory));

        $response->assertRedirect(route('inventories.index'));

        $this->assertSoftDeleted($inventory);
    }
}
