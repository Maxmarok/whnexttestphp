<?php

namespace Tests\Feature;

use App\Models\Ads;
use Database\Seeders\AdsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdsTest extends TestCase
{
    use RefreshDatabase;

    public function test_ads_creating(): void
    {
        $data = [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomNumber(7, false),
            'photos' => [
                fake()->imageUrl(320, 320, 'animals', true),
                fake()->imageUrl(320, 320, 'animals', true),
            ],
        ];

        $response = $this->post(route('api.ads.create'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id'
            ],
        ]);
    }

    public function test_ads_list_getting()
    {
        $this->seed(AdsSeeder::class);

        $response = $this->post(route('api.ads.list'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'price',
                        'photo',
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ],
        ]);
    }

    public function test_ads_item_without_fields_getting()
    {
        $ad = Ads::factory()->create();
        $data = [
            'id' => $ad->id,
        ];

        $response = $this->post(route('api.ads.item'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'title',
                'price',
                'photo',
            ],
        ]);
    }

    public function test_ads_item_with_fields_getting()
    {
        $ad = Ads::factory()->create();
        $data = [
            'id' => $ad->id,
            'fields' => true,
        ];

        $response = $this->post(route('api.ads.item'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'title',
                'price',
                'photo',
                'photos',
                'description',
            ],
        ]);
    }
}
