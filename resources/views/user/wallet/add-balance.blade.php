@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Wallet',
        'path' => ['Settings', 'Wallet'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden bg-black h-[340px]">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Buy Balance</p>
            </div>
            <div class="p-6">
                <form action="{{ route('wallet.add-balance.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        @include('components.input-icon', [
                            'icon' => 'UEA',
                            'label' => 'Purchase Amount',
                            'name' => 'amount',
                        ])
                    </div>
                    <button class="p-2 bg-orange rounded text-white">Add Balance</button>
                </form>
                <div class="bg-blue-500 text-sm mt-4 p-4 rounded-lg text-white">
                    <p><i class="bi bi-info-circle-fill"></i> Notice:</p>
                    <p>Min UEA 10.00, Max UEA 150,000.00, Fee 0%.</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden bg-black text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Balance [ Total Balance : @money($user->profile[0]->balance) ]</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    @include('components.print')

                    <div class="w-[900px] lg:w-auto">
                        <table class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border">Date</td>
                                    <td class="table-border">Amount</td>
                                    <td class="table-border">Payment</td>
                                    <td class="table-border">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($histories) != 0)
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td class="table-border">{{ $history->created_at }}</td>
                                            <td class="table-border">@money($history->amount)</td>
                                            <td class="table-border">
                                                <a href="{{ route('wallet.invoice', ['id' => $history->id]) }}"
                                                    class="{{ $history->isPaid == 1 ? 'bg-green' : 'bg-red-500' }} px-2 py-1 rounded">
                                                    Payment
                                                </a>
                                            </td>
                                            <td class="table-border">
                                                @if ($history->status == 'pending' or $history->status == 'reject')
                                                    <button class="bg-red-500 first-letter:uppercase px-2 py-1 rounded">
                                                        {{ $history->status }}
                                                    </button>
                                                @else
                                                    <button class="bg-green first-letter:uppercase px-2 py-1 rounded">
                                                        {{ $history->status }}
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="table-border">
                                        <td class="p-4">No data available in the table</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between text-sm">
                        <div class="flex gap-2 items-center mb-4">
                        </div>
                        <div class="flex items-center gap-4 my-7">
                            <a href="" class="block">Previous</a>
                            <ul>
                                <li class="w-7 h-7 flex justify-center items-center  rounded bg-orange">1</li>
                            </ul>
                            <a href="" class="block">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
