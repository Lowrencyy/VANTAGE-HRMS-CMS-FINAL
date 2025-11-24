@php
    $colors = [
        'pending'  => 'bg-yellow-100 text-yellow-800',
        'approved' => 'bg-blue-100 text-blue-800',
        'denied'   => 'bg-red-100 text-red-800',
        'paid'     => 'bg-green-100 text-green-800',
    ];
    $label = ucfirst($status);
@endphp

<span class="px-2 py-1 rounded text-xs font-semibold {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
    {{ $label }}
</span>
