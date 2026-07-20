<?php

namespace Tests\Feature;

use App\Models\CollectionRequest;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\WasteRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartnerCollectionAreaTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_partners_can_access_the_partner_area(): void
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);

        $this->actingAs($resident)
            ->get(route('partner.dashboard'))
            ->assertForbidden();
    }

    public function test_dashboard_redirects_partner_to_partner_area(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);

        $this->actingAs($partner)
            ->get(route('dashboard'))
            ->assertRedirect(route('partner.dashboard'));
    }

    public function test_partner_can_accept_a_pending_request_with_collection_date(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $collectionRequest = $this->createCollectionRequest();
        $scheduledDate = now()->addDay()->toDateString();

        $response = $this->actingAs($partner)
            ->post(route('partner.collection-requests.accept', $collectionRequest), [
                'scheduled_date' => $scheduledDate,
            ]);

        $response->assertRedirect(route('partner.collection-requests.show', $collectionRequest));
        $this->assertDatabaseHas('collection_requests', [
            'id' => $collectionRequest->id,
            'partner_id' => $partner->id,
            'status' => CollectionRequest::STATUS_ACCEPTED,
        ]);
        $this->assertSame($scheduledDate, $collectionRequest->fresh()->scheduled_date->toDateString());
    }

    public function test_partner_can_complete_an_accepted_request(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $collectionRequest = $this->createCollectionRequest($partner);

        $this->actingAs($partner)
            ->patch(route('partner.collection-requests.complete', $collectionRequest))
            ->assertRedirect(route('partner.collection-requests.show', $collectionRequest));

        $this->assertSame(CollectionRequest::STATUS_COMPLETED, $collectionRequest->fresh()->status);
        $this->assertSame(WasteRecord::STATUS_COLLECTED, $collectionRequest->wasteRecord->fresh()->status);
    }

    public function test_partner_can_cancel_an_accepted_request(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $collectionRequest = $this->createCollectionRequest($partner);

        $this->actingAs($partner)
            ->patch(route('partner.collection-requests.cancel', $collectionRequest))
            ->assertRedirect(route('partner.collection-requests.show', $collectionRequest));

        $this->assertSame(CollectionRequest::STATUS_CANCELLED, $collectionRequest->fresh()->status);
        $this->assertSame(WasteRecord::STATUS_AVAILABLE, $collectionRequest->wasteRecord->fresh()->status);
    }

    public function test_partner_cannot_change_a_request_accepted_by_another_partner(): void
    {
        $partner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $otherPartner = User::factory()->create(['role' => User::ROLE_PARTNER]);
        $collectionRequest = $this->createCollectionRequest($otherPartner);

        $this->actingAs($partner)
            ->patch(route('partner.collection-requests.complete', $collectionRequest))
            ->assertNotFound();

        $this->assertSame(CollectionRequest::STATUS_ACCEPTED, $collectionRequest->fresh()->status);
        $this->assertSame(WasteRecord::STATUS_REQUESTED, $collectionRequest->wasteRecord->fresh()->status);
    }

    private function createCollectionRequest(?User $partner = null): CollectionRequest
    {
        $resident = User::factory()->create(['role' => User::ROLE_RESIDENT]);
        $category = WasteCategory::query()->create([
            'name' => 'Resíduos orgânicos '.fake()->unique()->word(),
            'active' => true,
        ]);
        $wasteRecord = WasteRecord::query()->create([
            'user_id' => $resident->id,
            'waste_category_id' => $category->id,
            'description' => 'Material separado para coleta',
            'quantity' => 3,
            'unit' => 'kg',
            'status' => WasteRecord::STATUS_REQUESTED,
        ]);

        return CollectionRequest::query()->create([
            'waste_record_id' => $wasteRecord->id,
            'resident_id' => $resident->id,
            'partner_id' => $partner?->id,
            'requested_date' => now()->toDateString(),
            'scheduled_date' => $partner ? now()->addDay()->toDateString() : null,
            'status' => $partner ? CollectionRequest::STATUS_ACCEPTED : CollectionRequest::STATUS_PENDING,
        ]);
    }
}
