@section('title', 'Surat > Detail Surat')

<x-app-layout>
    <div class="max-w-7xl mx-auto">
        {{-- Card konten utama --}}
        <div class="bg-white/80 backdrop-blur-lg shadow-xl rounded-3xl p-6 sm:p-8 border border-white/20">

            {{-- Bagian Atas: Info Surat & Tombol Aksi --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                {{-- Info Surat --}}
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-blue-900">{{ $surat->judul }}</h2>
                    <div class="text-sm text-gray-600  mt-2 space-y-1">
                        <p><span class="font-semibold">Nomor:</span> {{ $surat->nomor_surat }}</p>
                        <p><span class="font-semibold">Kategori:</span> {{ $surat->kategori->nama_kategori }}</p>
                        <p><span class="font-semibold">Diarsipkan pada:</span> {{ $surat->created_at->format('d F Y') }}</p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="border bg-gray-200  text-gray-700px-4 py-2 px-4 rounded-lg hover:bg-gray-400 transition font-semibold text-sm">
                        Kembali
                    </a>
                    <a href="{{ route('surat.edit', $surat->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-md font-semibold text-sm inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z" />
                        </svg>
                        Edit Surat
                    </a>
                </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700 mb-6">

            {{-- Preview PDF dalam Iframe --}}
            <div class="w-full h-[75vh] bg-gray-200 rounded-xl overflow-hidden">
                <iframe src="{{ route('surat.stream', $surat->id) }}" class="w-full h-full" style="border: none;"></iframe>
            </div>

        </div>
    </div>
</x-app-layout>
