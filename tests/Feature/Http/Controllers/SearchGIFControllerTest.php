<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FavoriteGif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SearchGIFControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }

    /**
     * A basic feature test example.
     */
    public function test_search_gif_by_query(): void
    {
        $response = $this->get(route('gif.index',['query' => 'cat', 'limit' => 2]));

        $response->assertStatus(200)->assertJsonCount(2);
    }


    /**
     * A basic feature test example.
     */
    public function test_search_gif_without_query(): void
    {
        $response = $this->get(route('gif.index', ['limit' => 2]));

        $response->assertInvalid(['query']);
    }

    /**
     * A basic feature test example.
     */
    public function test_search_gif_by_id(): void
    {
        $response = $this->get(route('gif.show', ['id' => "hs67xo8fGYfx5KlBgV"]));

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) => $json
                ->where('type', "gif")
                ->where("id", "hs67xo8fGYfx5KlBgV")
                ->etc()
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_search_gif_by_wrong_id(): void
    {
        $response = $this->get(route('gif.show', ['id' => "141"]));

        $response->assertStatus(200)->assertContent('[]');
    }

    /**
     * A basic feature test example.
     */
    public function test_save_favorite_gif(): void
    {
        $gif = FavoriteGif::factory()->make();
        $response = $this->post(route('gif.store'), $gif->toArray());

        $response->assertStatus(200)->assertJson(fn (AssertableJson $json) => $json
                ->where('gif_id', $gif->gif_id)
                ->where("alias", $gif->alias)
                ->where("user_id", $gif->user_id)
                ->etc()
        );
    }

    /**
     * A basic feature test example.
     */
    public function test_save_favorite_gif_null_user_or_dont_exists(): void
    {
        $gif = FavoriteGif::factory()->make(['user_id' => -1]);
        $response = $this->post(route('gif.store'), $gif->toArray());

        $response->assertInvalid(['user_id']);
    }
}
