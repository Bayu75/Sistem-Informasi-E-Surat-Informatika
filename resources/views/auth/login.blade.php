@extends('layouts.guest')

@section('title', 'Login - SIERA')

@section('content')
    <main class="flex min-h-screen items-center justify-center px-4 py-8">
        <section class="w-full max-w-md">

            {{-- Logo dan Judul --}}
            <div class="mb-8 text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-lg">
                    <svg
                        class="h-9 w-9 text-blue-600"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M22 9L12 4L2 9L12 14L22 9Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M6 11.5V16C6 17.657 8.686 19 12 19C15.314 19 18 17.657 18 16V11.5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold tracking-wide text-white">
                    SIERA
                </h1>

                <p class="mt-2 text-sm text-blue-100/80">
                    Sistem Informasi E-Surat Informatika
                </p>
            </div>

            {{-- Card Login --}}
            <div class="rounded-2xl bg-white p-8 shadow-2xl shadow-blue-950/20">
                <div class="mb-7">
                    <h2 class="text-2xl font-semibold text-slate-800">
                        Masuk ke Sistem
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Silakan masuk menggunakan akun kampus Anda
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 p-3 text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Email
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4 6H20V18H4V6Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M4 7L12 13L20 7"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="email@kampus.ac.id"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm text-slate-700 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                            Password
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M8 10V7C8 4.79 9.79 3 12 3C14.21 3 16 4.79 16 7V10"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="Masukkan password"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm text-slate-700 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="mt-2 w-full rounded-xl bg-blue-600 px-4 py-3 text-center text-base font-medium text-white shadow-md shadow-blue-600/30 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 active:scale-[0.99]"
                    >
                        Masuk
                    </button>
                </form>
            </div>

            <p class="mt-5 text-center text-xs text-blue-100/70">
                © 2025 Universitas Udayana · SIERA v1.0.0
            </p>

        </section>
    </main>
@endsection