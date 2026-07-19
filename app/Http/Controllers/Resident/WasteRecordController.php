<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\WasteCategory;
use App\Models\WasteRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WasteRecordController extends Controller
{
    public function index(Request $request): View
    {
        return view('resident.waste-records.index', [
            'wasteRecords' => $request->user()
                ->wasteRecords()
                ->with('wasteCategory')
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('resident.waste-records.create', [
            'categories' => $this->activeCategories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $wasteRecord = $request->user()->wasteRecords()->create([
            ...$this->validatedData($request),
            'status' => WasteRecord::STATUS_AVAILABLE,
        ]);

        return redirect()
            ->route('resident.waste-records.show', $wasteRecord)
            ->with('success', 'Resíduo cadastrado com sucesso.');
    }

    public function show(Request $request, WasteRecord $wasteRecord): View
    {
        $this->ensureOwnership($request, $wasteRecord);

        return view('resident.waste-records.show', [
            'wasteRecord' => $wasteRecord->load(['wasteCategory', 'collectionRequests']),
        ]);
    }

    public function edit(Request $request, WasteRecord $wasteRecord): View
    {
        $this->ensureOwnership($request, $wasteRecord);
        abort_if($wasteRecord->status === WasteRecord::STATUS_COLLECTED, 403, 'Resíduos coletados não podem ser editados.');

        return view('resident.waste-records.edit', [
            'wasteRecord' => $wasteRecord,
            'categories' => $this->activeCategories(),
        ]);
    }

    public function update(Request $request, WasteRecord $wasteRecord): RedirectResponse
    {
        $this->ensureOwnership($request, $wasteRecord);
        abort_if($wasteRecord->status === WasteRecord::STATUS_COLLECTED, 403, 'Resíduos coletados não podem ser editados.');

        $wasteRecord->update($this->validatedData($request));

        return redirect()
            ->route('resident.waste-records.show', $wasteRecord)
            ->with('success', 'Resíduo atualizado com sucesso.');
    }

    public function cancel(Request $request, WasteRecord $wasteRecord): RedirectResponse
    {
        $this->ensureOwnership($request, $wasteRecord);
        abort_unless($wasteRecord->status === WasteRecord::STATUS_AVAILABLE, 422, 'Apenas resíduos disponíveis podem ser cancelados.');

        $wasteRecord->update(['status' => WasteRecord::STATUS_CANCELLED]);

        return redirect()
            ->route('resident.waste-records.show', $wasteRecord)
            ->with('success', 'Resíduo cancelado.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'waste_category_id' => [
                'required',
                Rule::exists('waste_categories', 'id')->where('active', true),
            ],
            'description' => ['required', 'string', 'max:1000'],
            'quantity' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'unit' => ['required', 'string', 'max:50'],
        ]);
    }

    private function activeCategories()
    {
        return WasteCategory::query()->where('active', true)->orderBy('name')->get();
    }

    private function ensureOwnership(Request $request, WasteRecord $wasteRecord): void
    {
        abort_unless($wasteRecord->user_id === $request->user()->id, 404);
    }
}
