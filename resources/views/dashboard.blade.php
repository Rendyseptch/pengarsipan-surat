@section('title', 'Kategori Surat')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800  leading-tight">
            {{ __('Sistem Arsip Surat desa Karangduren ') }}
        </h2>
        <p class="text-sm text-gray-600  mt-1">
            Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.
        </p>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Card konten utama dibuat melayang dengan rounded-3xl agar serasi dengan sidebar --}}
        <div class="bg-white  backdrop-blur-lg shadow-xl rounded-3xl p-6 border border-white/20">

            {{-- Bagian atas: search & tombol --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <form action="{{ route('dashboard') }}" method="GET" class="flex w-full md:w-2/5">
                    <input type="text" name="search" placeholder="   Cari berdasarkan judul surat..."
                        class="flex-1 border-gray-300  rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 "
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-gray-100 transition shadow-md">
                        Cari
                    </button>
                </form>

                <div class="flex flex-col md:flex-row md:space-x-2 w-full md:w-auto gap-2">
                    <a href="{{ route('surat.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-md transition text-center font-semibold">
                        + Arsipkan Surat
                    </a>
                    <a href="{{ route('surat.export') }}"
                        class="border bg-green-500 text-white  font-bold px-4 py-2 rounded-lg hover:bg-green-700 hover:text-white  transition inline-flex items-center justify-center">
                        Export Data
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="overflow-x-auto">
                <table id="dataSurat" class="min-w-full table-auto text-sm">
                    {{-- Header tabel dibuat lebih minimalis --}}
                    <thead class="bg-gray-100 ">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600  rounded-tl-lg">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Nomor Surat</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Judul</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Waktu Arsip</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-600  rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                   <tbody>
@foreach ($surats as $surat)
<tr class="border-b border-gray-200 transition">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800 ">{{ $surat->nomor_surat }}</td>
                        <td class="px-4 py-3">{{ $surat->kategori->nama_kategori }}</td>
                        <td class="px-4 py-3">{{ $surat->judul }}</td>
                        <td class="px-4 py-3">{{ $surat->created_at->format('d M Y H:i') }}</td>
                        {{-- Tombol aksi diubah menjadi link teks agar lebih bersih --}}
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('surat.show', $surat->id) }}"
                                class="font-medium text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 transition">Lihat</a>
                            <a href="{{ route('surat.download', $surat->id) }}"
                                class="font-medium text-white bg-green-500 px-4 py-2 rounded-lg hover:bg-green-600 transition">Unduh</a>
                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST"
                                class="delete-form inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn-delete  text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition">Hapus</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#dataSurat').DataTable({
                    responsive: true,
                    paging: true,
                    ordering: true,
                    searching: false, // Pencarian dinonaktifkan karena sudah ada form custom
                    language: {
                        lengthMenu: "Tampilkan MENU data per halaman",
                        zeroRecords: "Tidak ada data yang cocok dengan pencarian Anda",
                        info: "Menampilkan halaman ",
                        infoEmpty: "Tidak ada data tersedia",
                        infoFiltered: "(disaring dari total MAX data)",
                        paginate: {
                            previous: "«",
                            next: "»"
                        }
                    }
                });

                $(document).on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6d28d9',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        </script>
    @endpush
</x-app-layout>
