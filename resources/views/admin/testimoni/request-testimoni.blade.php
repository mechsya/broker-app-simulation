@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Testimoni',
        'path' => ['Beranda', 'Permintaan Testimoni'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Testimoni</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Foto</td>
                                <td class="table-border">Judul</td>
                                <td class="table-border">Deskripsi</td>
                                <td class="table-border">Pengguna</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($pendingTestimonials) != 0)
                                @foreach ($pendingTestimonials as $pendingTestimonial)
                                    <tr class="table-border">
                                        <td class="table-border">
                                            <img src="{{ asset('') }}storage/testimoni/{{ $pendingTestimonial->image }}"
                                                width="55" class="m-auto" />
                                        </td>
                                        <td class="table-border">{{ $pendingTestimonial->title }}</td>
                                        <td class="table-border">{{ $pendingTestimonial->description }}</td>
                                        <td class="table-border">{{ $pendingTestimonial->user->username }}</td>
                                        <td class="table-border">
                                            <div class="flex gap-2 justify-center">
                                                <form
                                                    action="{{ route('dashboard.testimonials.update', ['id' => $pendingTestimonial->id, 'method' => 'success']) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="p-2 rounded bg-green">Setujui</button>
                                                </form>
                                                <form
                                                    action="{{ route('dashboard.testimonials.update', ['id' => $pendingTestimonial->id, 'method' => 'reject']) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="p-2 rounded bg-red-500">Tolak</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-border">
                                    <td class="p-4">Tidak ada data tersedia di tabel</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
