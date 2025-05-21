@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Saldo',
        'path' => ['Beranda', 'Permintaan Saldo'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Saldo</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Tanggal</td>
                                <td class="table-border">No</td>
                                <td class="table-border">Pengguna</td>
                                <td class="table-border">Bukti Pembayaran</td>
                                <td class="table-border">Pembayaran Ke</td>
                                <td class="table-border">Jumlah</td>
                                <td class="table-border">Catatan</td>
                                <td class="table-border">Status Dibayar</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($balances as $balance)
                                <tr class="table-border">
                                    <td class="table-border">{{ $balance->created_at }}</td>
                                    <td class="table-border">{{ $balance->code }}</td>
                                    <td class="table-border">{{ $balance->user->username }}</td>
                                    <td class="flex justify-center items-center h-20">
                                        @if (!$balance->proof)
                                            <p class="font-semibold text-lg">404</p>
                                        @else
                                            <img src="{{ asset('') }}storage/proof-balance/{{ $balance->proof }}"
                                                width="55" />
                                        @endif
                                    </td>
                                    <td class="table-border">{{ $balance->paymentTo }}</td>
                                    <td class="table-border">@money($balance->amount)</td>
                                    <td class="table-border">{{ $balance->note }}</td>
                                    <td class="table-border">
                                        @if ($balance->isPaid == 1)
                                            <button class="bg-green rounded px-3 py-1">DIBAYAR</button>
                                        @else
                                            <button class="bg-red-500 rounded px-3 py-1">BELUM DIBAYAR</button>
                                        @endif
                                    </td>
                                    <td class="table-border">
                                        @if ($balance->status == 'active')
                                            <div class="flex justify-center">
                                                <button
                                                    class="bg-green font-semibold h-10 rounded w-20 flex justify-center items-center">
                                                    <i class="fa-solid fa-circle-check text-lg text-white"></i>
                                                </button>
                                            </div>
                                        @else
                                            <form class="flex justify-center" method="POST"
                                                action="{{ route('dashboard.balances.requests.approve', ['id' => $balance->id, 'userId' => $balance->user->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-green font-semibold h-10 px-3 rounded flex justify-center items-center">
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
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
