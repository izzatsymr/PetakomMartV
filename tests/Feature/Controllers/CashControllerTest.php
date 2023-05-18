<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Cash;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CashControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_cash()
    {
        $allCash = Cash::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-cash.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_cash.index')
            ->assertViewHas('allCash');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_cash()
    {
        $response = $this->get(route('all-cash.create'));

        $response->assertOk()->assertViewIs('app.all_cash.create');
    }

    /**
     * @test
     */
    public function it_stores_the_cash()
    {
        $data = Cash::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-cash.store'), $data);

        $this->assertDatabaseHas('cash', $data);

        $cash = Cash::latest('id')->first();

        $response->assertRedirect(route('all-cash.edit', $cash));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_cash()
    {
        $cash = Cash::factory()->create();

        $response = $this->get(route('all-cash.show', $cash));

        $response
            ->assertOk()
            ->assertViewIs('app.all_cash.show')
            ->assertViewHas('cash');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_cash()
    {
        $cash = Cash::factory()->create();

        $response = $this->get(route('all-cash.edit', $cash));

        $response
            ->assertOk()
            ->assertViewIs('app.all_cash.edit')
            ->assertViewHas('cash');
    }

    /**
     * @test
     */
    public function it_updates_the_cash()
    {
        $cash = Cash::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber,
            'opening_cash' => $this->faker->randomNumber(2),
            'closing_cash' => $this->faker->randomNumber(2),
            'short_cash' => $this->faker->randomNumber(2),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('all-cash.update', $cash), $data);

        $data['id'] = $cash->id;

        $this->assertDatabaseHas('cash', $data);

        $response->assertRedirect(route('all-cash.edit', $cash));
    }

    /**
     * @test
     */
    public function it_deletes_the_cash()
    {
        $cash = Cash::factory()->create();

        $response = $this->delete(route('all-cash.destroy', $cash));

        $response->assertRedirect(route('all-cash.index'));

        $this->assertSoftDeleted($cash);
    }
}
