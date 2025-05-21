@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Dasbor Admin',
        'subpage' => 'Panel Kontrol',
        'path' => ['Beranda', 'Dasbor Admin'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-4">
        <div class="rounded-lg w-full overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg class="text-orange" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                            height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Pengguna Baru</p>
                            <p>total Pengguna Baru</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">{{ count(App\Models\User::get()) }} Pengguna</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs1" width="400" height="100"></canvas>
            </div>
        </div>

        <div class="rounded-lg w-full overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg class="text-orange" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 16 16" height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Total Pengguna</p>
                            <p>total Pengguna</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">{{ count(App\Models\User::get()) }} Pengguna</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs2" width="400" height="100"></canvas>
            </div>
        </div>

        <div class="rounded-lg w-full overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg stroke="currentColor" class="text-orange" fill="currentColor" stroke-width="0"
                            viewBox="0 0 640 512" height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M352 288h-16v-88c0-4.42-3.58-8-8-8h-13.58c-4.74 0-9.37 1.4-13.31 4.03l-15.33 10.22a7.994 7.994 0 0 0-2.22 11.09l8.88 13.31a7.994 7.994 0 0 0 11.09 2.22l.47-.31V288h-16c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h64c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8zM608 64H32C14.33 64 0 78.33 0 96v320c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V96c0-17.67-14.33-32-32-32zM48 400v-64c35.35 0 64 28.65 64 64H48zm0-224v-64h64c0 35.35-28.65 64-64 64zm272 192c-53.02 0-96-50.15-96-112 0-61.86 42.98-112 96-112s96 50.14 96 112c0 61.87-43 112-96 112zm272 32h-64c0-35.35 28.65-64 64-64v64zm0-224c-35.35 0-64-28.65-64-64h64v64z">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Pendapatan</p>
                            <p>total Pendapatan</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">@money(App\Models\Profile::sum('balance'))</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs3" width="400" height="100"></canvas>
            </div>
        </div>
    </section>

    <section class="w-full overflow-hidden rounded-lg text-white/80 mb-4">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Saldo</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Tanggal</td>
                                <td class="table-border">No</td>
                                <td class="table-border">Pengguna</td>
                                <td class="table-border">Bukti Pembayaran</td>
                                <td class="table-border">Pembayaran Kepada</td>
                                <td class="table-border">Jumlah</td>
                                <td class="table-border">Catatan</td>
                                <td class="table-border">Status Terbayar</td>
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
                                            <button class="bg-green rounded px-3 py-1">TERBAYAR</button>
                                        @else
                                            <button class="bg-red-500 rounded px-3 py-1">BELUM TERBAYAR</button>
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
            </div>
        </div>
    </section>

    <section class="w-full overflow-hidden rounded-lg text-white/80 mb-4">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Penarikan</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
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

            </div>
        </div>
    </section>

    <section class="w-full overflow-hidden rounded-lg text-white/80 mb-4">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Testimoni</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
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
                            @endif
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
