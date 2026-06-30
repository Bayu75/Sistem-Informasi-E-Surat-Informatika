<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Mahasiswa - SIERA')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-screen overflow-hidden bg-slate-50 text-slate-700">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
        @click="sidebarOpen = false"
        style="display: none;"
    ></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-gradient-to-b from-slate-900 via-blue-950 to-cyan-800 text-white transition duration-300 lg:translate-x-0"
        :class="{ 'translate-x-0': sidebarOpen }"
    >
        <div class="flex h-20 shrink-0 items-center gap-3 border-b border-white/10 px-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none">
                    <path d="M22 9L12 4L2 9L12 14L22 9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 11.5V16C6 17.657 8.686 19 12 19C15.314 19 18 17.657 18 16V11.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div>
                <h1 class="text-sm font-bold">SIERA</h1>
                <p class="text-xs text-cyan-100/70">Portal Mahasiswa</p>
            </div>
        </div>


@php
    $active = $activeMenu ?? '';
@endphp
        @php
        $menus = [
            ['label' => 'Dashboard', 'url' => '/mahasiswa/dashboard', 'key' => 'dashboard', 'icon' => 'grid'],
            ['label' => 'Pengumuman', 'url' => '/mahasiswa/pengumuman', 'key' => 'pengumuman', 'icon' => 'bell'],
            ['label' => 'Ajukan Surat', 'url' => '/mahasiswa/ajukan', 'key' => 'ajukan', 'icon' => 'file'],
            [
                'label' => 'Status Pengajuan',
                'url' => '/mahasiswa/status',
                'key' => 'status',
                'icon' => 'clock',
                'badge' => $jumlahNotifikasi
            ],
            ['label' => 'Riwayat Pengajuan', 'url' => '/mahasiswa/riwayat', 'key' => 'riwayat', 'icon' => 'history'],
        ];
        @endphp

        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5">
            @foreach ($menus as $menu)
                <a
                    href="{{ $menu['url'] }}"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ $active === $menu['key']
                        ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/25'
                        : 'text-cyan-100/80 hover:bg-white/10 hover:text-white' }}"
                >
                    <span class="flex items-center gap-3">
                        @if ($menu['icon'] === 'grid')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M4 4H10V10H4V4ZM14 4H20V10H14V4ZM4 14H10V20H4V14ZM14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        @elseif ($menu['icon'] === 'bell')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif ($menu['icon'] === 'file')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                        @elseif ($menu['icon'] === 'clock')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M3 12A9 9 0 1 0 6 5.3M3 4V10H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @endif

                        {{ $menu['label'] }}
                    </span>

                    @if(isset($menu['badge']) && $menu['badge'] > 0)
                        <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-amber-500 px-1.5 text-xs text-white">
                            {{ $menu['badge'] }}
                        </span>
                    @endif
                </a>
            @endforeach
        </nav>

        <div class="shrink-0 border-t border-white/10 bg-cyan-900/30 p-4">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-cyan-400 text-sm font-bold text-white">
                    B
                </div>

                <div>
                    <p class="text-sm font-semibold">
                        {{ auth()->user()->mahasiswa->nama }}
                    </p>
                    <p class="text-xs text-cyan-100/60">
                        {{ auth()->user()->mahasiswa->nim }}
                    </p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="text-sm text-blue-100/70 transition hover:text-white"
                >
                    ↳ Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="h-screen overflow-y-auto lg:ml-64">
        <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-4 lg:px-8">
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    class="rounded-lg border border-slate-200 p-2 lg:hidden"
                    @click="sidebarOpen = true"
                >
                    ☰
                </button>

                <div>
                    <h2 class="text-xl font-semibold text-slate-800">@yield('page-title')</h2>
                    <p class="mt-1 text-sm text-slate-500">Selasa, 26 Mei 2026</p>
                </div>
            </div>

            @if(($activeMenu ?? '') !== 'ajukan')
                <a
                    href="/mahasiswa/ajukan"
                    class="hidden items-center gap-2 rounded-xl bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 sm:flex"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                        <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                    Ajukan Surat
                </a>
            @endif
        </header>

        <main class="min-h-[calc(100vh-5rem)] p-4 lg:p-8">
            @if(session('error'))
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
</body>
</html>