@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Penarikan',
        'path' => ['Beranda', 'Permintaan Penarikan'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Penarikan</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Tanggal</td>
                                <td class="table-border">Jumlah</td>
                                <td class="table-border">Penarikan ke</td>
                                <td class="table-border">Nama</td>
                                <td class="table-border">No Rekening</td>
                                <td class="table-border">Catatan</td>
                                <td class="table-border">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $withdraw)
                                <tr class="table-border">
                                    <td class="table-border">{{ $withdraw->created_at }}</td>
                                    <td class="table-border">@money($withdraw->amount)</td>
                                    <td class="table-border">{{ $withdraw->bank->bank }}</td>
                                    <td class="table-border">{{ $withdraw->bank->name }}</td>
                                    <td class="table-border">{{ $withdraw->bank->noRekening }}</td>
                                    <td class="table-border">{{ $withdraw->note }}</td>
                                    <td class="table-border">
                                        <button
                                            class="{{ $withdraw->status == 'success' ? 'bg-green' : 'bg-red-500' }} first-letter:uppercase px-2 py-1 rounded">{{ $withdraw->status }}</button>
                                    </td>
                                    <td class="table-border">
                                        <div class="flex justify-evenly">
                                            <form class="flex justify-center" method="POST"
                                                action="{{ route('dashboard.balances.withdrawals.update', ['id' => $withdraw->id, 'method' => 'success']) }}">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-green font-semibold h-10 w-10 rounded flex justify-center items-center">
                                                    <i class="fa-solid fa-circle-check text-lg text-white"></i>
                                                </button>
                                            </form>
                                            <form class="flex justify-center" method="POST"
                                                action="{{ route('dashboard.balances.withdrawals.update', ['id' => $withdraw->id, 'method' => 'reject']) }}">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="font-semibold h-10 rounded w-10 bg-red-500 flex justify-center items-center">
                                                    <i class="fa-solid fa-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between text-sm">
                    <div class="flex gap-2 items-center mb-4">
                        <p>Menampilkan 1 sampai 10 dari 13 entri</p>
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
