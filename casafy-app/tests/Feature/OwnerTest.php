<?php

namespace Tests\Feature;

use App\Models\Owner;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;

class OwnerTest extends TestCase
{
    use DatabaseMigrations;

    public $structure = [
        'data' => [
                '0' =>  [
                    "id",
                    "name",
                    "email",
                    "homes",
                    "created_at",
                    "updated_at"
                ]
            ]
        ];
    /**
     * A feature test for create a owner
     *
     * @return void
     */
    public function test_create_owner()
    {
        $owner = Owner::factory()->make();
        $this->postJson('api/users', $owner->toArray())
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }

    /**
     * A feature test for read a owner
     *
     * @return void
     */
    public function test_read_owner()
    {
        $owner = Owner::factory()->create();
        $this->getJson('api/users/'.$owner->id)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }
    /**
     * A feature test for update a owner
     *
     * @return void
     */
    public function test_update_owner()
    {
        $owner = Owner::factory()->create();
        $owner->email = 'new_email@email.com';
        $this->putJson('api/users/'.$owner->id, $owner->toArray())
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure($this->structure);
    }
    /**
     * A feature test for read a owner
     *
     * @return void
     */
    public function test_delete_owner()
    {
        $owner = Owner::factory()->create();
        $this->deleteJson('api/users/'.$owner->id)
        ->assertStatus(Response::HTTP_ACCEPTED);
    }
}
