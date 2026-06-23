<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kaprodi - SIERA')</title>

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
        class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-gradient-to-b from-slate-900 via-indigo-950 to-violet-900 text-white transition duration-300 lg:translate-x-0"
        :class="{ 'translate-x-0': sidebarOpen }"
    >
        {{-- Logo --}}
        <div class="flex h-20 shrink-0 items-center gap-3 border-b border-white/10 px-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                    <path d="M22 9L12 4L2 9L12 14L22 9Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M6 11.5V16C6 17.657 8.686 19 12 19C15.314 19 18 17.657 18 16V11.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>

            <div>
                <h1 class="text-sm font-bold">SIERA</h1>
                <p class="text-xs text-indigo-100/70">Kepala Program Studi</p>
            </div>
        </div>

        @php
            $menus = [
                ['key' => 'dashboard', 'label' => 'Dashboard', 'url' => '/kaprodi/dashboard', 'icon' => 'grid'],
                ['key' => 'persetujuan', 'label' => 'Persetujuan Pengajuan', 'url' => '/kaprodi/persetujuan-pengajuan', 'icon' => 'check', 'badge' => 1],
                ['key' => 'riwayat', 'label' => 'Riwayat Keputusan', 'url' => '/kaprodi/riwayat', 'icon' => 'history'],
                ['key' => 'pengumuman', 'label' => 'Pengumuman', 'url' => '/kaprodi/pengumuman', 'icon' => 'megaphone'],
            ];

            $active = $activeMenu ?? '';
        @endphp

        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5">
            @foreach ($menus as $menu)
                <a
                    href="{{ $menu['url'] }}"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ $active === $menu['key']
                        ? 'bg-violet-500 text-white shadow-lg shadow-violet-500/25'
                        : 'text-indigo-100/75 hover:bg-white/10 hover:text-white' }}"
                >
                    <span class="flex items-center gap-3">
                        @if ($menu['icon'] === 'grid')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4H10V10H4V4ZM14 4H20V10H14V4ZM4 14H10V20H4V14ZM14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        @elseif ($menu['icon'] === 'check')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10M5 3H19V21H5V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @elseif ($menu['icon'] === 'history')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M3 12A9 9 0 1 0 6 5.3M3 4V10H9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M3 11L21 4V20L3 13V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        @endif

                        {{ $menu['label'] }}
                    </span>

                    @isset($menu['badge'])
                        <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 text-xs text-white">
                            {{ $menu['badge'] }}
                        </span>
                    @endisset
                </a>
            @endforeach
        </nav>

        {{-- User --}}
        <div class="shrink-0 border-t border-white/10 bg-violet-950/30 p-4">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-500 text-sm font-bold">
                    D
                </div>

                <div>
                    <p class="text-sm font-semibold">
                        {{ auth()->user()->kaprodi->nama }}
                    </p>
                    <p class="text-xs text-indigo-100/60">
                        {{ auth()->user()->kaprodi->nip }}
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

            <div class="hidden items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm text-slate-600 sm:flex">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <path d="M18 8A6 6 0 0 0 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="currentColor" stroke-width="2"/>
                </svg>
                1 menunggu keputusan
            </div>
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