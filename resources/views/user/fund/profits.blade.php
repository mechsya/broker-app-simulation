@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Investment Profit',
        'path' => ['Home', 'Profit'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Profit [ Total Profit: @money($totalProfit) ]</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print', ['model' => 'profit-fund'])

                <div class="w-[900px] lg:w-auto">
                    <table id="container-table" class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border w-[25%]">Date</td>
                                <td class="table-border w-[25%]">Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($profits) != 0)
                                @foreach ($profits as $profit)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $profit->created_at }}</td>
                                        <td class="table-border">@money($profit->amount)</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-border">
                                    <td class="p-4" colspan="4">No data available in table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
