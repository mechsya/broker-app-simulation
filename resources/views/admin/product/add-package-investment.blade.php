@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Paket Investasi',
        'path' => ['Pengaturan', 'Paket Investasi'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden bg-black"
            x-bind:style="'max-height: ' + $ref.containerAdd.scrollHeight + 'px';">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Tambah Paket Investasi</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('dashboard.investments.store') }}" x-ref="containerAdd">
                    @csrf
                    <div>
                        @include('components.input', [
                            'label' => 'Nama Paket',
                            'name' => 'name',
                        ])

                        @include('components.input', [
                            'type' => 'tel',
                            'label' => 'Min',
                            'name' => 'min',
                        ])

                        @include('components.input', [
                            'type' => 'tel',
                            'label' => 'Maks',
                            'name' => 'max',
                        ])

                        <label class="text-white/70" for="profit">Keuntungan</label>
                        <div class="flex items-center">
                            <input type="tel" placeholder="Masukkan Keuntungan" id="profit" name="profit"
                                class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-l-lg p-3 bg-black mb-4 border-r-0">

                            <select name="estimasiProfit"
                                class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-r-lg p-[11px] bg-black mb-4">
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                            </select>
                        </div>

                        @include('components.input', [
                            'type' => 'tel',
                            'label' => 'Kontrak',
                            'name' => 'contract',
                        ])
                    </div>
                    <button class="p-2 bg-orange rounded text-white">Tambah Paket</button>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Daftar Paket Investasi</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    @include('components.print')

                    <div class="w-[900px] lg:w-auto">
                        <table class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border">Nama</td>
                                    <td class="table-border">Min</td>
                                    <td class="table-border">Maks</td>
                                    <td class="table-border">Keuntungan</td>
                                    <td class="table-border">Kontrak</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $package->name }}</td>
                                        <td class="table-border">@money($package->min)</td>
                                        <td class="table-border">@money($package->max)</td>
                                        <td class="table-border">
                                            {{ $package->profit }}% / {{ $package->estimasiProfit }}
                                        </td>
                                        <td class="table-border">{{ $package->contract }} {{ $package->estimasiProfit }}
                                        </td>
                                        <td class="table-border ">
                                            <div class="flex justify-center">
                                                <form
                                                    action="{{ route('dashboard.investments.destroy', ['id' => $package->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="bg-red-500 h-10 rounded w-10 flex justify-center items-center">
                                                        <i class="bi bi-trash3 text-lg"></i>
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
        </div>
    </section>
@endsection
