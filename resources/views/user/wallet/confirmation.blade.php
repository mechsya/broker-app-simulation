@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Confirmation',
        'path' => ['Home', 'Confirmation'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden"
            x-bind:style="'max-height: ' + $ref.containerAdd.scrollHeight + 'px';">
            <div class="bg-black rounded-lg">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Confirmation</p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('wallet.confirmation.put', ['id' => $balance->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div x-ref="containerAdd">
                            @csrf
                            <div>
                                @include('components.input', [
                                    'label' => 'Purchase Amount',
                                    'name' => 'amount',
                                    'readonly' => true,
                                    'value' => "AED $balance->amount",
                                ])

                                <div>
                                    <label class="text-white/70">Payment To</label>
                                    <select name="paymentTo" required
                                        class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-lg p-3 bg-black mb-4">
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->bank }}">
                                                {{ $bank->bank }} ACC:{{ $bank->noRekening }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @include('components.input', [
                                    'label' => 'Note',
                                    'name' => 'note',
                                ])

                                <div class="flex gap-2 mt-2 mb-5">
                                    <p class="text-white/75">Upload</p>
                                    <input type="file" name="proof" class="text-white/70" />
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('wallet.add-balance') }}"
                                    class="p-2 bg-red-500 rounded text-white">Back</a>
                                <button class="p-2 bg-orange rounded text-white">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>History</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    <div class="w-[900px] lg:w-auto">
                        <table id="container-table" class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border">Date</td>
                                    <td class="table-border">Invoice</td>
                                    <td class="table-border">Amount</td>
                                    <td class="table-border">Payment To</td>
                                    <td class="table-border">Info</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($histories) != 0)
                                    @foreach ($histories as $history)
                                        <tr class="table-border">
                                            <td class="table-border">{{ $history->created_at }}</td>
                                            <td class="table-border">{{ $history->code }}</td>
                                            <td class="table-border">@money($history->amount)</td>
                                            <td class="table-border">{{ $history->paymentTo }}</td>
                                            <td class="table-border">{{ $history->note }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="table-border">
                                        <td class="p-4">No data available in table</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
