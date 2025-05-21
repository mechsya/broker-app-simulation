@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Profit',
        'path' => ['Home', 'Profit'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Profit [ Total Profit : @money($totalProfit) ]</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border w-[25%]">Date</td>
                                <td class="table-border w-[25%]">No</td>
                                <td class="table-border w-[25%]">Type</td>
                                <td class="table-border w-[25%]">Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tradings) != 0)
                                @foreach ($tradings as $trading)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $trading->created_at }}</td>
                                        <td class="table-border">{{ $trading->code }}</td>
                                        <td class="table-border">{{ $trading->package }}</td>
                                        <td class="table-border">@money($trading->amount)</td>
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

                <div class="flex justify-between text-sm">
                    <div class="flex gap-2 items-center mb-4">
                    </div>
                    <div class="flex items-center gap-4 my-7">
                        <a href="" class="block">Previous</a>
                        <ul>
                            <li class="w-7 h-7 flex justify-center items-center rounded bg-orange">1</li>
                        </ul>
                        <a href="" class="block">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
