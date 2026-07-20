@php
    [$label, $classes] = match ($status) {
        'pending' => ['Pendente', 'bg-amber-100 text-amber-800'],
        'accepted' => ['Aceita', 'bg-blue-100 text-blue-800'],
        'completed' => ['Concluída', 'bg-emerald-100 text-emerald-800'],
        'cancelled' => ['Cancelada', 'bg-red-100 text-red-700'],
        default => [$status, 'bg-slate-100 text-slate-700'],
    };
@endphp

<span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $classes }}">{{ $label }}</span>
