<?php

namespace Tests\Feature;

use App\Models\Owner;
use App\Models\Home;
use App\Http\Resources\HomeResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseMigrations;

    public $structure = [
    'data' => [
            '0' =>  [
                "id",
                "address",
                "bedrooms",
                "bathrooms",
                "total_area",
                "purcharsed",
                "value",
                "discount",
                "owner_id",
                "expired",
                "created_at",
                "updated_at"
            ]
        ]
    ];
    /**
     * A feature test for get all the properties associated with an user.
     *
     * @return void
     */
    public function test_get_all_properties()
    {
        $user = Owner::factory()->create();
        $homes = Home::factory()->count(10)->make();
        $user->homes()->saveMany($homes);

        $response = $this->get(route('user.all_properties', $user->id));
        $response->assertResourceAPI(HomeResource::collection($homes));
        $response->assertStatus(200);
    }
    /**
     * A feature test for change the object purcharsed property.
     *
     * @return void
     */
    public function test_change_purcharsed_property()
    {
        $home = Home::factory()->create();
        $response = $this->patch(route('home.change_purcharsed', [$home->id, 1]));
        $response->assertStatus(200);
    }

    /**
     * A feature test for create a home
     *
     * @return void
     */
    public function test_create_home()
    {
        $user = Owner::factory()->create();
        $home = Home::factory()->make();
        $this->post('api/homes', $home->toArray())
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }

    /**
     * A feature test for read a home
     *
     * @return void
     */
    public function test_read_home()
    {
        $home = Home::factory()->create();
        $this->getJson('api/homes', array($home->id))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }
    /**
     * A feature test for update a home
     *
     * @return void
     */
    public function test_update_home()
    {
        $home = Home::factory()->create();
        $home->email = 'new_email@email.com';
        $this->putJson('api/homes/'.$home->id, $home->toArray())
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }
    /**
     * A feature test for read a home
     *
     * @return void
     */
    public function test_delete_home()
    {
        $home = Home::factory()->create();
        $this->deleteJson('api/homes/'.$home->id)
            ->assertStatus(Response::HTTP_ACCEPTED);
    }
}
