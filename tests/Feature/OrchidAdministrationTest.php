<?php

namespace Tests\Feature;

use App\Models\CollectionPoint;
use App\Models\CollectionRequest;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\WasteRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrchidAdministrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_administration_screens(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $category = WasteCategory::query()->create([
            'name' => 'Borra de café',
            'active' => true,
        ]);
        $point = CollectionPoint::query()->create([
            'name' => 'Ponto Central',
            'address' => 'Rua Verde, 100',
            'neighborhood' => 'Centro',
            'city' => 'Cotia',
            'state' => 'SP',
            'active' => true,
        ]);
        $wasteRecord = WasteRecord::query()->create([
            'user_id' => $resident->id,
            'waste_category_id' => $category->id,
            'description' => 'Material orgânico',
            'quantity' => 2,
            'unit' => 'kg',
            'status' => WasteRecord::STATUS_REQUESTED,
        ]);
        $collectionRequest = CollectionRequest::query()->create([
            'waste_record_id' => $wasteRecord->id,
            'resident_id' => $resident->id,
            'collection_point_id' => $point->id,
            'requested_date' => now()->toDateString(),
            'status' => CollectionRequest::STATUS_PENDING,
        ]);

        $routes = [
            route('platform.main'),
            route('platform.systems.users'),
            route('platform.systems.users.edit', $resident),
            route('platform.categories'),
            route('platform.categories.create'),
            route('platform.categories.edit', $category),
            route('platform.collection-points'),
            route('platform.collection-points.create'),
            route('platform.collection-points.edit', $point),
            route('platform.waste-records'),
            route('platform.waste-records.show', $wasteRecord),
            route('platform.collection-requests'),
            route('platform.collection-requests.show', $collectionRequest),
        ];

        foreach ($routes as $route) {
            $this->actingAs($admin)->get($route)->assertOk();
        }
    }

    public function test_admin_can_assign_partner_and_change_request_status(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $category = WasteCategory::query()->create([
            'name' => 'Cascas e sementes',
            'active' => true,
        ]);
        $wasteRecord = WasteRecord::query()->create([
            'user_id' => $resident->id,
            'waste_category_id' => $category->id,
            'description' => 'Material orgânico',
            'quantity' => 3,
            'unit' => 'kg',
            'status' => WasteRecord::STATUS_REQUESTED,
        ]);
        $collectionRequest = CollectionRequest::query()->create([
            'waste_record_id' => $wasteRecord->id,
            'resident_id' => $resident->id,
            'status' => CollectionRequest::STATUS_PENDING,
        ]);

        $this->actingAs($admin)
            ->post(route('platform.collection-requests.show', [
                'collectionRequest' => $collectionRequest,
                'method' => 'save',
            ]), [
                'collectionRequest' => [
                    'status' => CollectionRequest::STATUS_ACCEPTED,
                    'partner_id' => $partner->id,
                ],
            ])
            ->assertRedirect(route('platform.collection-requests.show', $collectionRequest));

        $this->assertDatabaseHas('collection_requests', [
            'id' => $collectionRequest->id,
            'partner_id' => $partner->id,
            'status' => CollectionRequest::STATUS_ACCEPTED,
        ]);
    }
}
