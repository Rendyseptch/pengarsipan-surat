{{-- Breadcrumb/Title --}}
<div class="text-lg font-semibold text-white w-full hidden md:flex items-center">
    <a href="{{ route('dashboard') }}" class="text-blue-300 hover:text-blue">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-white">
        @yield('title', 'Page')
    </span>
</div>

{{-- Tombol toggle untuk mobile --}}
<button id="sidebarToggle" class="md:hidden text-white focus:outline-none">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

{{-- Avatar Dropdown --}}
<div class="flex justify-end items-center w-full space-x-4">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white transition">
                <img class="h-10 w-10 rounded-full object-cover"
                    src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=FFFFFF&background=A78BFA' }}"
                    alt="{{ Auth::user()->name }}">
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebar && sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
</script>
