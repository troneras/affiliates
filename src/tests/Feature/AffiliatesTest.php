<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Affiliate;
use Inertia\Testing\Assert;
use Illuminate\Http\UploadedFile;

class AffiliatesTest extends TestCase
{

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

    }

    /**
     * Test import affiliates upload success
     *
     * @return void
     */
    public function test_import_affiliates_success()
    {
        $filename = 'affiliates.txt';

        $this->actingAs($this->user);
        Affiliate::truncate();
        $this->assertTrue(!Affiliate::count());

        $file = UploadedFile::fake()->create($filename, file_get_contents(public_path('affiliates.txt')), 'txt');

        $response = $this->put(route('affiliates.store'), [
            'file' => $file
        ]);

        $this->assertTrue(Affiliate::exists());
        $this->assertTrue(Affiliate::count() == 32);
        $this->assertIsArray(Affiliate::first()->toArray());
    }

    /**
     * Test import affiliates upload missed fail
     *
     * @return void
     * @group affiliates
     */
    public function test_import_affiliates_validation_error_missed_file()
    {
        $this->actingAs($this->user);
        Affiliate::truncate();
        $this->assertTrue(!Affiliate::count());

        $response = $this->put(route('affiliates.store'), [
            'file' => null
        ]);

        $this->assertTrue(!Affiliate::exists());
        $this->assertTrue(!Affiliate::count());
    }

    /**
     * Test import affiliates upload wrong file
     *
     * @return void
     * @group affiliates
     */
    public function test_import_affiliates_validation_error_invalid_format()
    {

        $this->actingAs($this->user);
        Affiliate::truncate();
        $this->assertTrue(!Affiliate::count());

        $file = UploadedFile::fake()->create('affiliates.txt', 120, 'txt');

        $response = $this->put(route('affiliates.store'), [
            'file' => $file
        ]);

        $this->assertTrue(!Affiliate::exists());
        $this->assertTrue(!Affiliate::count());
    }

    /**
     * Test inertia index page range 100 km from dublin
     *
     * @return void
     * @group affiliates
     */
    public function test_affiliates_index_range_100_km_from_dublin_default()
    {
        $this->artisan('affiliates:import', ['file' => 'public/affiliates.txt']);
        $this->actingAs($this->user);

        $this->get(route('affiliates', ['distance' => 100]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
                ->has('affiliates.data.0', fn(Assert $assert) => $assert
                    ->where('affiliate_id', 26)
                    ->where('name', 'Moesha Bateman')
                    ->where('distance', '98.9')
                )
            );
        $this->get(route('affiliates', ['distance' => 100, 'page' => 2]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 6)
            );
    }

    /**
     * Test inertia index page with range 200 km from dublin
     *
     * @return void
     * @group affiliates
     */
    public function test_affiliates_index_range_200_km_from_dublin()
    {
        $this->artisan('affiliates:import', ['file' => 'public/affiliates.txt']);
        $this->actingAs($this->user);

        $this->get(route('affiliates', ['distance' => 200]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
            );
        $this->get(route('affiliates', ['distance' => 200, 'page' => 2]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
            );
        $this->get(route('affiliates', ['distance' => 200, 'page' => 3]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 5)
            );
    }

    /**
     * Test inertia index page with range 500 km from dublin
     *
     * @return void
     * @group affiliates
     */
    public function test_affiliates_index_range_500_km_from_dublin()
    {
        $this->artisan('affiliates:import', ['file' => 'public/affiliates.txt']);
        $this->actingAs($this->user);

        $this->get(route('affiliates', ['distance' => 500]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
            );
        $this->get(route('affiliates', ['distance' => 500, 'page' => 2]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
            );
        $this->get(route('affiliates', ['distance' => 500, 'page' => 3]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 10)
            );
        $this->get(route('affiliates', ['distance' => 500, 'page' => 4]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Affiliates/Index')
                ->has('affiliates.data', 2)
            );
    }


}
