@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Buku',
        'path' => ['Dasbor', 'Buku'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden ">
            <div class="bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Unggah Buku</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('download.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            @include('components.input', [
                                'label' => 'Judul',
                                'name' => 'title',
                            ])

                            @include('components.input', [
                                'label' => 'Deskripsi',
                                'name' => 'description',
                            ])

                            <div class="mb-4">
                                <input type="file" name="file" class="text-white/70" />
                                <p class="text-white/70 mt-2">Silakan unggah file PDF</p>
                            </div>
                        </div>
                        <button class="p-2 bg-orange rounded text-white">Unggah File</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Daftar Buku</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    <div class="w-[900px] lg:w-auto">
                        <table id="container-table" class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border">Judul</td>
                                    <td class="table-border">Deskripsi</td>
                                    <td class="table-border">Diunduh</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $file->title }}</td>
                                        <td class="table-border">{{ $file->description }}</td>
                                        <td class="table-border">{{ $file->downloaded }} Unduhan</td>
                                        <td class="table-border">
                                            <form class="flex justify-center"
                                                action="{{ route('download.destroy', ['id' => $file->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="h-12 w-12 text-lg flex justify-center items-center rounded bg-red-500">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
