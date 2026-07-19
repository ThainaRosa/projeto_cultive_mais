@php
    [$label, $classes] = match ($status) {
        'available' => ['Disponível', 'bg-emerald-100 text-emerald-800'],
        'requested' => ['Solicitado', 'bg-amber-100 text-amber-800'],
        'collected' => ['Coletado', 'bg-teal-100 text-teal-800'],
        'cancelled' => ['Cancelado', 'bg-red-100 text-red-700'],
        'pending' => ['Pendente', 'bg-amber-100 text-amber-800'],
        'accepted' => ['Aceita', 'bg-blue-100 text-blue-800'],
        'completed' => ['Concluída', 'bg-emerald-100 text-emerald-800'],
        default => [$status, 'bg-stone-100 text-stone-700'],
    };
@endphp

<span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $classes }}">{{ $label }}</span>
