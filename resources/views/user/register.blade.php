@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Registration',
        'path' => ['Settings', 'Registration'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-[30%] rounded-lg overflow-hidden bg-black h-96">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Registration</p>
            </div>
            @include('components.unverified', ['label' => 'Balance Transfer'])
        </div>

        <div class="w-full lg:w-[70%] rounded-lg overflow-hidden bg-black text-white/80">
            <div class="w-full rounded-lg overflow-hidden bg-black">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Registration History</p>
                </div>

                <div class="p-4 lg:p-6 overflow-x-scroll">
                    @include('components.print')

                    <div class="w-[900px] lg:w-auto">
                        <table class="w-full table-border">
                            <thead>
                                <tr class="table-border">
                                    <td class="table-border w-[20%]">Username</td>
                                    <td class="table-border w-[20%]">Name</td>
                                    <td class="table-border w-[20%]">Email Address</td>
                                    <td class="table-border w-[20%]">Date</td>
                                    <td class="table-border w-[20%]">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-border">
                                    <td class="p-4">No data available in the table</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
