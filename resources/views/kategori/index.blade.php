@section('title', 'Kategori Surat')

<x-app-layout>
    <x-slot name="header">
        {{-- Header dibuat lebih bersih dan konsisten --}}
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Kategori Surat') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">
            Berikut ini adalah kategori yang bisa digunakan untuk melabel surat.
        </p>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Card konten utama disamakan dengan halaman lain (floating, rounded-3xl) --}}
        <div class="bg-white/80  backdrop-blur-lg shadow-xl rounded-3xl p-6 border border-white/20">

            {{-- Bagian atas: search & tombol --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <form action="{{ route('kategori.index') }}" method="GET" class="flex w-full md:w-2/5">
                    <input type="text" name="search" placeholder=" Cari nama kategori..."
                        class="flex-1 border-gray-300  rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2"
                        value="{{ request('search') }}">
                    {{-- Warna tombol disesuaikan dengan tema ungu --}}
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition shadow-md">
                        Cari
                    </button>
                </form>

                <a href="{{ route('kategori.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-md transition text-center font-semibold w-full md:w-auto">
                    + Tambah Kategori
                </a>
            </div>

            {{-- Data Table --}}
            <div class="overflow-x-auto">
                <table id="dataKategori" class="min-w-full table-auto text-sm">
                    {{-- Header tabel dibuat minimalis agar fokus pada data --}}
                    <thead class="bg-gray-100 border-b border-gray-500">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600  rounded-tl-lg">ID</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Nama Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 ">Keterangan</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-600  rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($kategoris as $kategori)
                            <tr class="border-b border-gray-200  hover:bg-blue-50  transition">
                                <td class="px-4 py-3 text-black">{{ $kategori->id }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800 ">{{ $kategori->nama_kategori }}</td>
                                <td class="px-4 py-3">{{ $kategori->keterangan }}</td>
                                {{-- Tombol aksi diubah menjadi link teks agar lebih rapi dan tidak ramai --}}
                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="font-medium bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Edit</a>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="delete-form inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete font-medium bg-red-600 text-white px-4 py-2 rounded-lg  hover:bg-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Script dipindahkan ke dalam layout utama via @push untuk best practice --}}
@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataKategori').DataTable({
            responsive: true,
            paging: true,
            ordering: true,
            searching: false,
            language: {
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: { previous: "&laquo;", next: "&raquo;" }
            },
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
                cancelButtonColor: '#6d28d9', // Warna ungu
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end', // Posisi notifikasi lebih baik di pojok
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    });
</script>
@endpush
