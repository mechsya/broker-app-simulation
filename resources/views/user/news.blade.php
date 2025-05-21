@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Latest News',
        'path' => ['Home', 'Latest News'],
    ])

    <section class="my-6 w-full">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white border-b border-white/25">
                <p>Latest Notifications</p>
            </div>
            <div class="text-white text-sm">
                <ul>
                    @if (count($news) != 0)
                        @foreach ($news as $item)
                            <li class="flex flex-col lg:flex-row items-center gap-6 hover:bg-white hover:text-black p-6">
                                <div class="w-40 h-40 bg-background rounded-lg bg-cover"
                                    style="background-image: url('{{ asset('') }}storage/cover/{{ $item->cover }}')">
                                </div>
                                <div class="w-[90%]">
                                    <div>
                                        {!! $item->content !!}
                                    </div>
                                    <p class="mt-6">{{ $item->created_at }}</p>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="p-4">
                            <p class="p-4">No News Available</p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
@endsection
