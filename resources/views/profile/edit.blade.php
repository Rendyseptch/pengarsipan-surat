@section('title', 'Profile')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Halo') }}
            {{ Auth::user()->name }}
            <span class="inline-block animate-wave"></span>
            <div>
                <p class="text-lg text-gray-600">
                    Kelola informasi profil Anda dan akun.
                </p>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <!-- Menu 1: Informasi Akun -->
            <div x-data="{ open: false }" class="bg-blue-900 shadow sm:rounded-lg">
                <button @click="open = !open" class="flex justify-between w-full p-4 text-left text-white font-semibold">
                    <span>Informasi Akun</span>
                    <span x-text="open ? '▲' : '▼'"></span>
                </button>
                <div x-show="open" x-transition class="p-4 border-t border-blue-700">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Menu 2: Update Password -->
            <div x-data="{ open: false }" class="bg-blue-900 shadow sm:rounded-lg">
                <button @click="open = !open"
                    class="flex justify-between w-full p-4 text-left text-white font-semibold">
                    <span>Update Password</span>
                    <span x-text="open ? '▲' : '▼'"></span>
                </button>
                <div x-show="open" x-transition class="p-4 border-t border-blue-700">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Menu 3: Hapus Akun -->
            <div x-data="{ open: false }" class="bg-blue-900 shadow sm:rounded-lg">
                <button @click="open = !open"
                    class="flex justify-between w-full p-4 text-left text-white font-semibold">
                    <span>Hapus Akun</span>
                    <span x-text="open ? '▲' : '▼'"></span>
                </button>
                <div x-show="open" x-transition class="p-4 border-t border-blue-700">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
