@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Berita',
        'path' => ['Dasbor', 'Berita'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden ">
            <div class="bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Unggah Berita</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="text-white/70">Konten</label>
                            <textarea name="content"
                                class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-lg p-3 bg-black mb-4">
                            </textarea>

                            <div class="mb-4">
                                <input type="file" name="cover" class="text-white/70" />
                            </div>
                        </div>

                        <button class="p-2 bg-orange rounded text-white">Unggah Berita</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Daftar Berita</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    @include('components.print')

                    <div class="w-[900px] lg:w-auto">
                        <table class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border">Sampul</td>
                                    <td class="table-border">Konten</td>
                                    <td class="table-border"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $news)
                                    <tr class="table-border">
                                        <td class="table-border">
                                            <img src="{{ asset('') }}storage/cover/{{ $news->cover }}" width="55"
                                                class="m-auto" />
                                        </td>
                                        <td class="table-border">{!! $news->content !!}</td>
                                        <td class="table-border">
                                            <form class="flex justify-center"
                                                action="{{ route('news.destroy', ['id' => $news->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="h-12 w-12 text-lg flex  justify-center items-center rounded bg-red-500">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between text-sm">
                        <div class="flex gap-2 items-center mb-4">
                            <p>Menampilkan 1 hingga 10 dari 13 entri</p>
                        </div>
                        <div class="flex items-center gap-4 my-7">
                            <a href="" class="block">Sebelumnya</a>
                            <ul>
                                <li class="w-7 h-7 flex justify-center items-center rounded bg-orange">1</li>
                            </ul>
                            <a href="" class="block">Berikutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
