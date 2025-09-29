<aside id="sidebar"
    {{-- Sidebar dibuat "melayang" dengan jarak dari tepi layar (top-4, left-4, bottom-4) dan sudut membulat (rounded-3xl) --}}
    class="fixed top-4 left-4 bottom-4 w-64 bg-blue-950 shadow-2xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40 rounded-3xl border border-blue-800/50"
    aria-label="Sidebar">

    <div class="overflow-y-auto py-4 px-3 h-full">
       {{-- Logo Section --}}
<div class="flex items-center mb-5 justify-center pt-2 pb-4">
    {{-- IKON MENU BARU --}}
    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
         viewBox="0 0 24 24" stroke-width="1.5"
         stroke="currentColor" class="w-9 h-9 text-blue-400">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 5.25h16.5M3.75 12h16.5m-16.5 6.75h16.5" />
    </svg>

    {{-- TEKS --}}
    <span class="self-center text-2xl font-extrabold whitespace-nowrap ml-3 text-white">
        MENU
    </span>
</div>
    

        <hr class="my-3 border-blue-800">

        {{-- Menu Navigation --}}
        <ul class="space-y-2 mt-8">
            {{-- Style link menu diubah agar memiliki indikator aktif yang jelas dan efek hover yang halus --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-3 text-base font-medium rounded-lg transition-all duration-200 group
                    {{ request()->routeIs('dashboard')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                    <svg class="h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="ml-3">Kelola Arsip</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kategori.index') }}"
                    class="flex items-center p-3 text-base font-medium rounded-lg transition-all duration-200 group
                    {{ request()->routeIs('kategori.*')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                    <svg class="w-6 h-6 {{ request()->routeIs('kategori.*') ? 'text-white' : 'text-blue-400 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6A2.25 2.25 0 0115.75 3.75h2.25A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75A2.25 2.25 0 0115.75 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path>
                    </svg>
                    <span class="ml-3">Kategori Surat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}"
                    class="flex items-center p-3 text-base font-medium rounded-lg transition-all duration-200 group
                    {{ request()->routeIs('about')
                        ? 'bg-blue-600 text-white shadow-lg'
                        : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                    <svg class="w-6 h-6 {{ request()->routeIs('about') ? 'text-white' : 'text-blue-400 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm-1.875 0c0 .517.42 1.5 1.875 1.5s1.875-.983 1.875-1.5m-3.75 0h3.75M9 12.75h3.75m-3.75 3h3.75M3.75 12h.008v.008H3.75V12zm.008 3h.008v.008H3.758V15zm0 3h.008v.008H3.758V18z"></path>
                    </svg>
                    <span class="ml-3">About</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
