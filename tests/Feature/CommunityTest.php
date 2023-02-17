<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Community;


class CommunityTest extends TestCase
{
    use RefreshDatabase;


    public function test_can_fetch_all_communities(){
        Community::factory()->count(3)->create();

        $response = $this->getJson(route('communities.index'));

 
        $response->assertOk();
    }

    public function test_can_fetch_single_community(){
        $community = Community::factory()->create();

        $response = $this->getJson(route('communities.show', $community));

        $response->assertOk();
    }

    public function test_community_name_is_required(){
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('communities.store'), [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }

    public function test_can_create_community(){
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('communities.store'), [
            'name' => 'Test Community'
        ]);

        $response->assertCreated();
    }

    public function guest_cannot_create_community(){
        $response = $this->postJson(route('communities.store'), [
            'name' => 'Test Community'
        ]);

        $response->assertUnauthorized();
    }

    public function test_can_update_community(){
        Sanctum::actingAs(User::factory()->create());

        $community = Community::factory()->create();

        $response = $this->putJson(route('communities.update', $community), [
            'name' => 'Test Community'
        ]);

        $response->assertOk();
    }

    public function test_can_delete_community(){
        Sanctum::actingAs(User::factory()->create());

        $community = Community::factory()->create();

        $response = $this->deleteJson(route('communities.destroy', $community));

        $response->assertNoContent();

        $this->assertSoftDeleted($community);
    }

    public function test_can_returns_a_json_api_error_object_when_a_community_is_not_found(){
        $response = $this->getJson(route('communities.show', 999));

        $response->assertJsonStructure([
            'error'
        ]);
    }
}