@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Pengguna',
        'path' => ['Beranda', 'Pengguna'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Semua Pengguna</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Foto Profil</td>
                                <td class="table-border">Nama</td>
                                <td class="table-border">Nama Pengguna</td>
                                <td class="table-border">Email</td>
                                <td class="table-border">Status Aktif</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) != 0)
                                @foreach ($users as $key => $user)
                                    <tr class="table-border">
                                        <td class="table-border">
                                            <img loading="lazy"
                                                src="{{ asset('') }}storage/photo-profile/{{ @$user->profile[0]->photoProfile ?? 'default.jpg' }}"
                                                width="55" class="m-auto" />
                                        </td>
                                        <td class="table-border">{{ $user->name }}</td>
                                        <td class="table-border">{{ $user->username }}</td>
                                        <td class="table-border">{{ $user->email }}</td>
                                        <td class="table-border">
                                            <button
                                                class="{{ $user->status == 'actived' ? 'bg-green' : 'bg-red-500' }} first-letter:uppercase px-2 py-1 rounded">{{ $user->status == 'actived' ? 'Aktif' : 'Tidak Aktif' }}</button>
                                        </td>
                                        <td class="table-border">
                                            <a style="display: flex; justify-content: center; align-items:center; width: 50px; height: 50px; margin: auto;"
                                                href="{{ route('dashboard.users.view', ['id' => $user->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                </svg>
                                            </a>
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
