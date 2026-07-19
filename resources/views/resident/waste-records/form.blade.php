@csrf

<div>
    <label for="waste_category_id" class="block text-sm font-bold text-emerald-950">Categoria</label>
    <select id="waste_category_id" name="waste_category_id" required class="mt-2 block w-full rounded-xl border-stone-300 focus:border-emerald-600 focus:ring-emerald-600">
        <option value="">Selecione uma categoria</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('waste_category_id', $wasteRecord?->waste_category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('waste_category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mt-6">
    <label for="description" class="block text-sm font-bold text-emerald-950">Descrição</label>
    <textarea id="description" name="description" rows="4" required maxlength="1000" class="mt-2 block w-full rounded-xl border-stone-300 focus:border-emerald-600 focus:ring-emerald-600" placeholder="Ex.: cascas de frutas separadas durante a semana">{{ old('description', $wasteRecord?->description) }}</textarea>
    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mt-6 grid gap-5 sm:grid-cols-2">
    <div>
        <label for="quantity" class="block text-sm font-bold text-emerald-950">Quantidade</label>
        <input id="quantity" name="quantity" type="number" min="0.01" step="0.01" required value="{{ old('quantity', $wasteRecord?->quantity) }}" class="mt-2 block w-full rounded-xl border-stone-300 focus:border-emerald-600 focus:ring-emerald-600">
        @error('quantity') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="unit" class="block text-sm font-bold text-emerald-950">Unidade</label>
        <input id="unit" name="unit" type="text" maxlength="50" required value="{{ old('unit', $wasteRecord?->unit) }}" class="mt-2 block w-full rounded-xl border-stone-300 focus:border-emerald-600 focus:ring-emerald-600" placeholder="Ex.: kg, litros ou unidades">
        @error('unit') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
    <a href="{{ $wasteRecord?->exists ? route('resident.waste-records.show', $wasteRecord) : route('resident.waste-records.index') }}" class="rounded-full border border-stone-300 px-6 py-3 text-center text-sm font-bold text-stone-600 hover:bg-stone-50">Cancelar</a>
    <button class="rounded-full bg-emerald-800 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700">{{ $submitLabel }}</button>
</div>
