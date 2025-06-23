<div class="p-4">
    <div class="text-white/70 p-6 grid h-full place-items-center text-sm">
        <div class="flex flex-col items-center">
            <img src="{{ asset('') }}images/unverified.png" alt="unverified" class="ml-3 w-28 h-28" />
            <p class="text-xl mt-4 font-semibold text-center">NOT VERIFIED</p>
            <p class="text-xs text-center">{{ $label }} Your balance has been deactivated. To transfer your AED
                balance,
                you must verify your account first.
            </p>
            <a href="/knc" class="bg-red-500 block mt-4 py-1 px-4 rounded">Click Here</a>
        </div>
    </div>
</div>
