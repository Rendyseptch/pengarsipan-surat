@section('title', 'Dashboard > Unggah Surat')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 leading-tight">
            {{ __('Unggah Surat Baru') }}
            <div>
                <p class="text-lg text-gray-200 dark:text-black">
                    Unggah surat yang telah terbit pada form ini untuk diarsipkan dengan tipe dokumen .pdf
                </p>
            </div>

        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-0 pt-0">
            <div class="bg-white   p-6 rounded-lg shadow-lg">
                <form action="{{route('surat.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nomor_surat" class="block text-gray-700 font-bold mb-2">Nomor Surat:</label>
                        <input type="text" id="nomor_surat" name="nomor_surat"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori_id" class="block text-gray-700 font-bold mb-2">Kategori:</label>
                        <select id="kategori_id" name="kategori_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            @foreach ($kategoriSurat as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-bold mb-2">Judul:</label>
                        <input type="text" id="judul" name="judul"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="file_path" class="block text-gray-700 font-bold mb-2">File Surat (PDF):</label>
                        <input type="file" id="file_path" name="file_path" accept=".pdf"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="flex justify-start">
                        <button>
                            <a href="{{ route('dashboard') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Kembali</a>
                        </button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Unggah Surat</button>
                    </div>
                </form>
    </div>

</x-app-layout>
