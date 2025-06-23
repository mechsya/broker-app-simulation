@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Dashboard',
        'subpage' => 'Control Panel',
        'path' => ['Home', 'Dashboard'],
    ])

    <section class="my-6 w-full lg:w-2/4">
        <div class="flex">
            <input class="text-white/50 w-full border border-white/30 rounded-l p-3 bg-black"
                value="{{ env('APP_URL') }}/refferal?reff={{ $user->username }}">
            <button class="bg-orange w-52 lg:w-44 text-white rounded-r">Copy link Referral</button>
        </div>

        <div class="w-full p-4 bg-black rounded-md border border-white/10 text-orange my-6 hover:scale-105 duration-300"
            style="background-image: url('{{ asset('') }}images/pattern.svg');">
            <div class="p-4 flex lg:flex-row flex-col gap-6 items-center">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                    stroke-linejoin="round" height="40px" width="40px" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <p class="text-white/80 text-xl">
                    {{ $packageActive ? 'Package ' . $packageActive->package->name : 'No Package Active' }}</p>
            </div>
            <div class="w-full mt-4 flex items-center justify-between">
                <p class="text-white/80">Actived Package</p>
                <a>Detail</a>
            </div>
        </div>

    </section>
    <!-- end copy refferal -->

    <!-- chart -->
    <section class="w-full flex flex-col lg:flex-row gap-4">
        <div class="rounded-lg overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg class="text-orange" stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 16 16" height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Referral</p>
                            <p>total referral</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">{{ $totalRefferal }} Member</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs1" width="400" height="100"></canvas>
            </div>
        </div>

        <div class="rounded-lg overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg stroke="currentColor" class="text-orange" fill="currentColor" stroke-width="0"
                            viewBox="0 0 640 512" height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M352 288h-16v-88c0-4.42-3.58-8-8-8h-13.58c-4.74 0-9.37 1.4-13.31 4.03l-15.33 10.22a7.994 7.994 0 0 0-2.22 11.09l8.88 13.31a7.994 7.994 0 0 0 11.09 2.22l.47-.31V288h-16c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h64c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8zM608 64H32C14.33 64 0 78.33 0 96v320c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V96c0-17.67-14.33-32-32-32zM48 400v-64c35.35 0 64 28.65 64 64H48zm0-224v-64h64c0 35.35-28.65 64-64 64zm272 192c-53.02 0-96-50.15-96-112 0-61.86 42.98-112 96-112s96 50.14 96 112c0 61.87-43 112-96 112zm272 32h-64c0-35.35 28.65-64 64-64v64zm0-224c-35.35 0-64-28.65-64-64h64v64z">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Bonus</p>
                            <p>total Bonus</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">AED 0.0</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs2" width="400" height="100"></canvas>
            </div>
        </div>

        <div class="rounded-lg overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg stroke="currentColor" class="text-orange" fill="currentColor" stroke-width="0" version="1.2"
                            baseProfile="tiny" viewBox="0 0 24 24" height="36px" width="36px"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 6c0-.587-.257-1.167-.75-1.562-.863-.69-2.121-.551-2.812.312l-2.789 3.486-2.449-1.836c-.864-.648-2.087-.493-2.762.351l-4 5c-.294.368-.438.811-.438 1.249v3h16v-10zM20 19h-16c-.552 0-1 .447-1 1s.448 1 1 1h16c.552 0 1-.447 1-1s-.448-1-1-1z">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Profit</p>
                            <p>total Profit</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">@money($profits)</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs3" width="400" height="100"></canvas>
            </div>
        </div>

        <div class="rounded-lg overflow-hidden hover:scale-105 duration-300">
            <div class="bg-black p-4 w-full" style="background-image: url({{ asset('') }}images/pattern.svg);">
                <div class="text-white/80">
                    <div class="flex gap-4 items-center flex-col lg:flex-row lg:text-start text-center">
                        <svg stroke="currentColor" class="text-orange" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" height="36px" width="36px" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M202.7 341.3V170.7c0-23.5 19-42.7 42.7-42.7h197v-21.3c0-23.5-18.9-42.7-42.3-42.7H92c-23.7 0-44 18.5-44 42v300c0 23.5 20.3 42 44 42h308c23.5 0 42.3-19.2 42.3-42.7V384h-197c-23.6 0-42.6-19.2-42.6-42.7z">
                            </path>
                            <path
                                d="M245 186v140c0 8.8 7.2 16 16 16h187c8.8 0 16-7.2 16-16V186c0-8.8-7.2-16-16-16H261c-8.8 0-16 7.2-16 16zm77.1 101.9c-19.3 1.2-35.2-14.7-34-34 1-15.9 13.9-28.8 29.9-29.9 19.3-1.2 35.2 14.7 34 34-1.1 16-14 28.9-29.9 29.9z">
                            </path>
                        </svg>
                        <div class="text-white/70 tracking-wide">
                            <p class="font-bold text-xl">Wallet</p>
                            <p>Your Saldo</p>
                        </div>
                    </div>
                    <div class="flex text-orange items-center justify-between mt-4">
                        <p class="text-xl font-semibold">@money($user->profile->balance)</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
            <div class="bg-black overflow-hidden">
                <canvas class="opacity-60" id="chartjs4" width="400" height="100"></canvas>
            </div>
        </div>
    </section>
    <!-- end chart -->

    <!-- reff -->
    <section class="w-full mt-6 overflow-hidden rounded-lg text-white/80">
        <div class="bg-black ">
            <div class="p-6 text-white border-b border-white/25">
                <p>Welcome</p>
            </div>
            <div class="p-6 text-white">
                <p>Welcome in HSB FOREX TRADE Panel Member</p>
                <p class="my-4">Your Referral Link:</p>
                <p class="text-2xl font-semibold">{{ env('APP_URL') }}/refferal?reff={{ $user->username }}</p>
            </div>
        </div>
    </section>
    <!-- end reff -->

    <!-- notification -->
    <section class="w-full flex flex-col my-6 lg:flex-row gap-6">
        <div class="w-full lg:w-2/4">
            <div class=" bg-black rounded-lg overflow-hidden">
                <div class="p-6 text-white border-b border-white/25">
                    <p>Update News</p>
                </div>
                <div class="text-white">
                    <ul>
                        <li class="flex items-center gap-6 hover:bg-white hover:text-black p-6">
                            <div class="w-10 h-10 bg-yellow-500 flex justify-center items-center rounded-lg">
                                <svg class="text-white" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 576 512" height="16px" width="16px"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M552 64H112c-20.858 0-38.643 13.377-45.248 32H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h496c13.255 0 24-10.745 24-24V88c0-13.255-10.745-24-24-24zM48 392V144h16v248c0 4.411-3.589 8-8 8s-8-3.589-8-8zm480 8H111.422c.374-2.614.578-5.283.578-8V112h416v288zM172 280h136c6.627 0 12-5.373 12-12v-96c0-6.627-5.373-12-12-12H172c-6.627 0-12 5.373-12 12v96c0 6.627 5.373 12 12 12zm28-80h80v40h-80v-40zm-40 140v-24c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H172c-6.627 0-12-5.373-12-12zm192 0v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-144v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0 72v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p>Technical Analysis at DailyFX</p>
                                <p>10-Aug-2022, 14:37:34</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-6 hover:bg-white hover:text-black p-6">
                            <div class="w-10 h-10 bg-yellow-500 flex justify-center items-center rounded-lg">
                                <svg class="text-white" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 576 512" height="16px" width="16px"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M552 64H112c-20.858 0-38.643 13.377-45.248 32H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h496c13.255 0 24-10.745 24-24V88c0-13.255-10.745-24-24-24zM48 392V144h16v248c0 4.411-3.589 8-8 8s-8-3.589-8-8zm480 8H111.422c.374-2.614.578-5.283.578-8V112h416v288zM172 280h136c6.627 0 12-5.373 12-12v-96c0-6.627-5.373-12-12-12H172c-6.627 0-12 5.373-12 12v96c0 6.627 5.373 12 12 12zm28-80h80v40h-80v-40zm-40 140v-24c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H172c-6.627 0-12-5.373-12-12zm192 0v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-144v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0 72v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p>Technical Analysis at DailyFX</p>
                                <p>10-Aug-2022, 14:37:34</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-6 hover:bg-white hover:text-black p-6">
                            <div class="w-10 h-10 bg-yellow-500 flex justify-center items-center rounded-lg">
                                <svg class="text-white" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 576 512" height="16px" width="16px"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M552 64H112c-20.858 0-38.643 13.377-45.248 32H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h496c13.255 0 24-10.745 24-24V88c0-13.255-10.745-24-24-24zM48 392V144h16v248c0 4.411-3.589 8-8 8s-8-3.589-8-8zm480 8H111.422c.374-2.614.578-5.283.578-8V112h416v288zM172 280h136c6.627 0 12-5.373 12-12v-96c0-6.627-5.373-12-12-12H172c-6.627 0-12 5.373-12 12v96c0 6.627 5.373 12 12 12zm28-80h80v40h-80v-40zm-40 140v-24c0-6.627 5.373-12 12-12h136c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H172c-6.627 0-12-5.373-12-12zm192 0v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0-144v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12zm0 72v-24c0-6.627 5.373-12 12-12h104c6.627 0 12 5.373 12 12v24c0 6.627-5.373 12-12 12H364c-6.627 0-12-5.373-12-12z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p>Technical Analysis at DailyFX</p>
                                <p>10-Aug-2022, 14:37:34</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-2/4 overflow-hidden ">
            <div class="bg-black rounded-lg ">
                <div class="p-6 text-white border-b border-white/25">
                    <p>Notification</p>
                </div>
                <div class="text-white">
                    <ul>
                        @foreach ($notifications as $notification)
                            <li class="flex text-white/70 items-center gap-6 hover:bg-white hover:text-black p-6">
                                <div class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-lg">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 64 512"
                                        height="16px" width="16px" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V320c0 17.7 14.3 32 32 32s32-14.3 32-32V64zM32 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-md">{{ $notification->header }}</p>
                                    <p>{{ $notification->created_at }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end notification -->
@endsection

@section('javascript')
    <script src="{{ asset('') }}js/chart.js"></script>
@endsection
