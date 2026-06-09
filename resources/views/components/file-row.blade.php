@props(['name', 'size' => null, 'primary' => false])

<div class="flex items-center justify-between rounded-xl border px-4 py-3 text-sm
    {{ $primary ? 'border-blue-200 bg-blue-50' : 'border-slate-200 bg-white' }}">
    <div class="flex items-center gap-3">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
            📄
        </div>

        <div>
            <p class="font-medium text-slate-700">{{ $name }}</p>

            @if ($size)
                <p class="text-xs text-slate-400">{{ $size }}</p>
            @endif
        </div>
    </div>

    <div class="flex items-center gap-4 text-xs font-semibold">
        <a href="#" class="text-blue-600 hover:text-blue-700">Lihat</a>

        @if ($primary)
            <a href="#" class="text-slate-500 hover:text-slate-700">Unduh</a>
        @endif
    </div>
</div>