@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Download',
        'path' => ['Home', 'Download'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Download</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="w-[900px] lg:w-auto">
                    <table id="container-table" class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Title</td>
                                <td class="table-border">Description</td>
                                <td class="table-border">Hits</td>
                                <td class="table-border">Status</td>
                                <td class="table-border">File</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($files) != 0)
                                @foreach ($files as $item)
                                    <tr class="table-border">
                                        <td class="table-border">{{ $item->title }}</td>
                                        <td class="table-border">{{ $item->description }}</td>
                                        <td class="table-border">{{ $item->downloaded }}</td>
                                        <td class="table-border">
                                            <button
                                                class="px-3 py-1 {{ $item->isDownloaded == 0 ? 'bg-red-500' : 'bg-green' }} rounded">
                                                {{ $item->isDownloaded == 0 ? 'Not Downloaded' : 'Downloaded' }}
                                            </button>
                                        </td>
                                        <td class="table-border">
                                            <button class="px-3 py-1 bg-green rounded">
                                                Download
                                            </button>
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
