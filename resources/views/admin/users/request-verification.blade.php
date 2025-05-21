@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Verifikasi',
        'path' => ['Beranda', 'Permintaan Verifikasi'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Semua Permintaan Verifikasi</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Foto Profil</td>
                                <td class="table-border">Nama</td>
                                <td class="table-border">Nama Pengguna</td>
                                <td class="table-border">Email</td>
                                <td class="table-border w-[15%]"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($usera) != 0)
                                @foreach ($usera as $key => $usera)
                                    <tr class="table-border">
                                        <td class="table-border">
                                            <img src="{{ asset('') }}storage/photo-profile/{{ $usera->profile[0]->photoProfile }}"
                                                width="55" class="m-auto" />
                                        </td>
                                        <td class="table-border">{{ $usera->name }}</td>
                                        <td class="table-border">{{ $usera->username }}</td>
                                        <td class="table-border">{{ $usera->email }}</td>
                                        <td class="table-border">
                                            <div class="flex" style="color: white;">
                                                <form method="POST"
                                                    action="{{ route('dashboard.users.update', ['id' => $usera->id]) }}"
                                                    class="w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <button id="button-password" class="bg-green py-3 w-20 rounded-lg mt-2"
                                                        name="status" value="actived">Setujui</button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('dashboard.users.update', ['id' => $usera->id]) }}"
                                                    class="w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <button id="button-password"
                                                        class="bg-red-500 py-3 w-20 rounded-lg mt-2" name="status"
                                                        value="noactived">Tolak</button>
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

                <div class="flex justify-between text-sm">
                    <div class="flex gap-2 items-center mb-4">
                        <p>Menampilkan 1 hingga 10 dari 13 entri</p>
                    </div>
                    <div class="flex items-center gap-4 my-7">
                        <a href="" class="block">Sebelumnya</a>
                        <ul>
                            <li class="w-7 h-7 flex justify-center items-center  rounded bg-orange">1</li>
                        </ul>
                        <a href="" class="block">Berikutnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
