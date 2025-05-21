<nav class="bg-black lg:w-[13%] h-dvh text-white duration-300 lg:block overflow-auto"
    x-bind:class="open ? 'w-[700px]' : 'w-0'">
    <div class="flex flex-col p-4 items-center border-b border-background">
        <p class="text-orange font-xl text-center mb-1"><span class="font-semibold">Welcome</span> User</p>
        <div class="w-20 h-20 rounded-full flex justify-center items-center border border-background">
            <div class="bg-cover w-16 h-16 rounded-full bg-background"
                style="background-image: url({{ asset('') }}storage/photo-profile/{{ @$user->profile[0]->photoProfile }});">
            </div>
        </div>
        <p class="text-center mt-4 opacity-60 text-sm">{{ @$user->name }}<br />({{ @$user->username }})</p>
    </div>

    <div class="mt-4">
        <ul class="h-auto">
            @if (@$user->role == 'admin')
                @foreach (App\Http\Controllers\Tools\SidebarController::admin() as $key => $item)
                    <li>
                        @if (isset($item['sub']))
                            <div x-data="{ open: false }">
                                <div x-on:click="open = !open"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                    <div class="border-r-2 border-b-2 border-white/80 w-2 h-2 -rotate-45">
                                    </div>
                                </div>

                                <div class="text-sm bg-[#303030] max-h-0 overflow-hidden duration-300" x-ref="container"
                                    x-bind:style="open ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''">
                                    <ul>
                                        @foreach ($item['sub'] as $sub)
                                            <li class="py-3 text-white/30 hover:text-white/70 ml-16">
                                                <a href="{{ route($sub['route']) }}">{{ $sub['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            @if ($item['route'] == 'logout')
                                <div onclick="logout()"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route($item['route']) }}"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                </a>
                            @endif
                        @endif
                    </li>
                @endforeach
            @else
                @foreach (App\Http\Controllers\Tools\SidebarController::user() as $key => $item)
                    <li>
                        @if (isset($item['sub']))
                            <div x-data="{ open: false }">
                                <div x-on:click="open = !open"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                    <div class="border-r-2 border-b-2 border-white/80 w-2 h-2 -rotate-45">
                                    </div>
                                </div>

                                <div class="text-sm bg-[#303030] max-h-0 overflow-hidden duration-300" x-ref="container"
                                    x-bind:style="open ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''">
                                    <ul>
                                        @foreach ($item['sub'] as $sub)
                                            <li class="py-3 text-white/30 hover:text-white/70 ml-16">
                                                <a href="{{ route($sub['route']) }}">{{ $sub['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            @if ($item['route'] == 'logout')
                                <div onclick="logout()"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route($item['route']) }}"
                                    class="px-4 py-3 flex items-center justify-between border-l-2 hover:bg-[#303030] hover:border-l-2 hover:border-orange {{ $item['route'] === $page ? 'bg-[#303030] border-l-2 border-orange' : 'border-transparent' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="bg-[#2B2B2B] text-white/70 h-10 w-10 rounded-full flex items-center justify-center">
                                            {!! $item['icon'] !!}
                                        </div>
                                        <p class="text-white/70 text-sm">{{ $item['name'] }}</p>
                                    </div>
                                </a>
                            @endif
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</nav>
