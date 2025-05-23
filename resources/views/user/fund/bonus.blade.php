@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Bonus',
        'path' => ['Home', 'Bonus'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Bonus [ Total Bonus: RM 0.00 ]</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                @include('components.print')

                <div class="w-[900px] lg:w-auto">
                    <table class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border w-[20%]">Date</td>
                                <td class="table-border w-[20%]">From</td>
                                <td class="table-border w-[20%]">Type</td>
                                <td class="table-border w-[20%]">Amount</td>
                                <td class="table-border w-[20%]">#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-border">
                                <td class="p-4">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
