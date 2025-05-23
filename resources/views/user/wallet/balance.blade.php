@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Wallet',
        'path' => ['Home', 'Wallet'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Balance [ @money($user->profile[0]->balance) ]</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border w-[16%] uppercase">CODE</td>
                                <td class="table-border w-[16%] uppercase">Date</td>
                                <td class="table-border w-[16%] uppercase">Amount</td>
                                <td class="table-border w-[16%] uppercase">Note</td>
                                <td class="table-border w-[16%] uppercase">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($balances) != 0)
                                @foreach ($balances as $balance)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $balance->code }}</td>
                                        <td class="table-border">{{ $balance->created_at }}</td>
                                        <td class="table-border">@money($balance->amount)</td>
                                        <td class="table-border">{{ $balance->note ? $balance->note : '-' }}</td>
                                        <td class="table-border">
                                            @if ($balance->status == 'success')
                                                <button
                                                    class="px-2 rounded py-1 bg-green first-letter:uppercase">{{ $balance->status }}</button>
                                            @else
                                                <button
                                                    class="px-2 rounded py-1 bg-red-500 first-letter:uppercase">{{ $balance->status }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-border">
                                    <td class="p-4" colspan="5">No data available in the table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
