<?php

namespace Tests\Feature;

use App\Models\CollectionRequest;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\WasteRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResidentWasteManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_residents_can_access_the_resident_area(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);

        $this->actingAs($partner)
            ->get(route('resident.dashboard'))
            ->assertForbidden();
    }

    public function test_resident_can_register_a_waste_record(): void
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $category = WasteCategory::query()->create([
            'name' => 'Borra de café',
            'active' => true,
        ]);

        $response = $this->actingAs($resident)->post(route('resident.waste-records.store'), [
            'waste_category_id' => $category->id,
            'description' => 'Borra de café da semana',
            'quantity' => 2.5,
            'unit' => 'kg',
        ]);

        $wasteRecord = WasteRecord::query()->firstOrFail();

        $response->assertRedirect(route('resident.waste-records.show', $wasteRecord));
        $this->assertDatabaseHas('waste_records', [
            'id' => $wasteRecord->id,
            'user_id' => $resident->id,
            'waste_category_id' => $category->id,
            'status' => WasteRecord::STATUS_AVAILABLE,
        ]);
    }

    public function test_resident_can_request_and_cancel_collection_for_available_waste(): void
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $wasteRecord = $this->createWasteRecord($resident);

        $response = $this->actingAs($resident)
            ->post(route('resident.collection-requests.store', $wasteRecord));

        $collectionRequest = CollectionRequest::query()->firstOrFail();

        $response->assertRedirect(route('resident.collection-requests.show', $collectionRequest));
        $this->assertSame(WasteRecord::STATUS_REQUESTED, $wasteRecord->fresh()->status);
        $this->assertDatabaseHas('collection_requests', [
            'id' => $collectionRequest->id,
            'resident_id' => $resident->id,
            'status' => CollectionRequest::STATUS_PENDING,
        ]);

        $this->actingAs($resident)
            ->patch(route('resident.collection-requests.cancel', $collectionRequest))
            ->assertRedirect(route('resident.collection-requests.show', $collectionRequest));

        $this->assertSame(CollectionRequest::STATUS_CANCELLED, $collectionRequest->fresh()->status);
        $this->assertSame(WasteRecord::STATUS_AVAILABLE, $wasteRecord->fresh()->status);
    }

    public function test_resident_cannot_view_another_residents_waste(): void
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $otherResident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $wasteRecord = $this->createWasteRecord($otherResident);

        $this->actingAs($resident)
            ->get(route('resident.waste-records.show', $wasteRecord))
            ->assertNotFound();
    }

    public function test_collected_waste_cannot_be_edited(): void
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $wasteRecord = $this->createWasteRecord($resident, WasteRecord::STATUS_COLLECTED);

        $this->actingAs($resident)
            ->get(route('resident.waste-records.edit', $wasteRecord))
            ->assertForbidden();
    }

    private function createWasteRecord(User $resident, string $status = WasteRecord::STATUS_AVAILABLE): WasteRecord
    {
        $category = WasteCategory::query()->create([
            'name' => 'Cascas e sementes '.fake()->unique()->word(),
            'active' => true,
        ]);

        return WasteRecord::query()->create([
            'user_id' => $resident->id,
            'waste_category_id' => $category->id,
            'description' => 'Resíduo orgânico separado',
            'quantity' => 1.5,
            'unit' => 'kg',
            'status' => $status,
        ]);
    }
}
