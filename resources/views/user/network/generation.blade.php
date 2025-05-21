@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Generation',
        'path' => ['Home', 'Generation'],
    ])

    <section class="my-6 w-full lg:w-2/4">
        <div class="flex">
            <input class="text-white/50 w-full border border-white/30 rounded-l p-3 bg-black"
                value="{{ env('APP_URL') }}/refferal?reff={{ $user->username }}">
            <button class="bg-orange w-52 lg:w-44 text-white rounded-r">Copy Referral URL</button>
        </div>
    </section>

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Generation</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">
            </div>
        </div>
    </section>
@endsection
