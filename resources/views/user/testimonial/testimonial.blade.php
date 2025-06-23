@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Testimonial',
        'path' => ['Home', 'Testimonial'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80 my-6">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Testimonial</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="w-[900px] lg:w-auto">
                    <table id="container-table" class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border w-[20%]">Date</td>
                                <td class="table-border">Subject</td>
                                <td class="table-border">View</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($testimonis) != 0)
                                @foreach ($testimonis as $testimoni)
                                    <tr class="table-border">
                                        <input type="hidden" name="imagev-{{ $testimoni->id }}"
                                            value="{{ $testimoni->image }}" />
                                        <input type="hidden" name="created_atv-{{ $testimoni->id }}"
                                            value="{{ $testimoni->created_at }}" />
                                        <input type="hidden" name="titlev-{{ $testimoni->id }}"
                                            value="{{ $testimoni->title }}" />
                                        <input type="hidden" name="userv-{{ $testimoni->id }}"
                                            value="{{ $testimoni->user->name }} ({{ $testimoni->user->username }})" />
                                        <input type="hidden" name="descriptionv-{{ $testimoni->id }}"
                                            value="{{ $testimoni->description }}" />

                                        <td class="table-border">{{ $testimoni->created_at }}</td>
                                        <td class="table-border">{{ $testimoni->title }}</td>
                                        <td class="table-border">
                                            <div class="flex justify-center" id="view-button">
                                                <img src="https://hsbglobaltrade.com/images/view.png" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-border">
                                    <td class="p-4" colspan="3">No data in table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        const viewButtons = document.querySelectorAll('#view-button');
        viewButtons.forEach((el, index) => {
            el.addEventListener('click', function() {
                const image = document.querySelector(`input[name=imagev-${index + 1}]`)
                const created = document.querySelector(`input[name=created_atv-${index + 1}]`)
                const title = document.querySelector(`input[name=titlev-${index + 1}]`)
                const user = document.querySelector(`input[name=userv-${index + 1}]`)
                const description = document.querySelector(`input[name=descriptionv-${index + 1}]`)

                const html = `
                    <img src="/storage/testimoni/${image.value}"/>
                    <div style="text-align: start;" class="mt-4">
                        <p>By: ${user.value}</p>
                        <p>Date: ${created.value}</p>
                        <p class="mt-4">${title.value}</p>
                        <p>${description.value}</p>
                    </div>
                `

                Swal.fire({
                    html: html,
                });
            })
        });
    </script>
@endsection
