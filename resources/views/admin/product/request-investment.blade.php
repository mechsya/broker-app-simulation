@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Investasi',
        'path' => ['Beranda', 'Permintaan Investasi'],
    ])

    <section class="my-6 w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Investasi</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Tanggal</td>
                                <td class="table-border">Bukti Pembayaran</td>
                                <td class="table-border">Kode</td>
                                <td class="table-border">Pengguna</td>
                                <td class="table-border">Paket</td>
                                <td class="table-border">Jumlah</td>
                                <td class="table-border">Status Pembayaran</td>
                                <td class="table-border">Berlaku Hingga</td>
                                <td class="table-border">Catatan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investment as $invest)
                                <tr class="table-border">
                                    <td class="table-border">{{ $invest->created_at }}</td>
                                    <td class="flex h-20 justify-center items-center">
                                        @if (!$invest->proof)
                                            <p class="font-semibold text-lg">404</p>
                                        @else
                                            <img src="{{ asset('') }}storage/proof-payment/{{ $invest->proof }}"
                                                width="70" />
                                        @endif
                                    </td>
                                    <td class="table-border">588NY6NR2YZ2</td>
                                    <td class="table-border">{{ $invest->user->username }}</td>
                                    <td class="table-border">Paket {{ $invest->package->name }}</td>
                                    <td class="table-border">@money($invest->amount)</td>
                                    <td class="table-border">
                                        @if ($invest->isPaid == 1)
                                            <button class="bg-green rounded px-3 py-1">TERBAYAR</button>
                                        @else
                                            <button class="bg-red-500 rounded px-3 py-1">BELUM TERBAYAR</button>
                                        @endif
                                    </td>
                                    <td class="table-border">
                                        {{ !$invest->expiresAt ? 'Silakan ACC untuk melihat' : $invest->expiresAt }}
                                    </td>
                                    <td class="table-border">{{ $invest->note }}</td>
                                    <td class="table-border">
                                        @if ($invest->status == 'active')
                                            <div class="flex justify-center">
                                                <button
                                                    class="bg-green font-semibold h-10 rounded w-20 flex justify-center items-center">
                                                    Sukses
                                                </button>
                                            </div>
                                        @else
                                            <form class="flex justify-center" method="POST"
                                                action="{{ route('dashboard.investments.requests.approve', ['id' => $invest->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-green font-semibold h-10 rounded w-20 flex justify-center items-center">
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
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('') }}js/chart.js"></script>
@endsection
