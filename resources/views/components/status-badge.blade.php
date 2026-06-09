@props(['status'])

@php
    $styles = [
        'Menunggu Verifikasi' => 'border-amber-300 bg-amber-50 text-amber-700',
        'Diverifikasi Admin' => 'border-blue-300 bg-blue-50 text-blue-700',
        'Diteruskan ke Kaprodi' => 'border-purple-300 bg-purple-50 text-purple-700',
        'Disetujui' => 'border-emerald-300 bg-emerald-50 text-emerald-700',
        'Ditolak' => 'border-red-300 bg-red-50 text-red-700',
        'Aktif' => 'border-emerald-300 bg-emerald-50 text-emerald-700',
        'Kadaluwarsa' => 'border-red-300 bg-red-50 text-red-700',
        'Nonaktif' => 'border-slate-300 bg-slate-100 text-slate-600',
    ];

    $class = $styles[$status] ?? 'border-slate-300 bg-slate-100 text-slate-600';
@endphp

<span class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold {{ $class }}">
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $status }}
</span>