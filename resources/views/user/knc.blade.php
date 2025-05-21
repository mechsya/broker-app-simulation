@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Know Your Customer (KYC)',
        'path' => ['Home', 'Know Your Customer (KYC)'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full overflow-hidden">
            <div class="bg-black rounded-lg">
                <div class="p-6 text-white/70 border-b border-white/25">
                    <p>Profile</p>
                </div>
                <div class="text-white/70 p-6 text-sm">
                    @if ($user->status == 'pending')
                        <div class="flex justify-center flex-col py-6 items-center">
                            <i class="fa-solid fa-spinner text-6xl mb-4 animate-spin"></i>
                            <p>Activation in Process</p>
                        </div>
                    @elseif ($user->status == 'actived')
                        <div class="flex justify-center flex-col py-6 items-center">
                            <i class="fa-solid fa-check text-6xl mb-4"></i>
                            <p>Activation Successful</p>
                        </div>
                    @else
                        <div>
                            <p>Please complete the verification form below and submit it to gain full access to your
                                account.</p>
                            <form action="{{ route('knc.update') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mt-10">
                                    @include('components.input-icon', [
                                        'label' => 'User ID',
                                        'name' => 'name',
                                        'value' => $user->name,
                                        'icon' => '<i class="fa fa-id-badge" aria-hidden="true"></i>',
                                    ])
                                </div>

                                <div class="mt-2 mb-4">
                                    @include('components.input-icon', [
                                        'label' => 'Password',
                                        'name' => 'password',
                                        'icon' => '<i class="fa fa-key"></i>',
                                    ])
                                </div>

                                <div class="my-2">
                                    <p class="text-white/70 mb-2">Upload Identity Card</p>
                                    <div class="relative rounded-lg overflow-hidden border border-white/25">
                                        <input type="file" name="identityCard"
                                            class="p-3 file:absolute file:-top-[2px] file:-right-2 file:px-6  file:text-white file:bg-blue-500 file:border-0 file:h-[50px]" />
                                    </div>
                                </div>

                                <div class="my-4">
                                    <p class="text-white/70 mb-2">Close Up Photo</p>
                                    <div class="relative rounded-lg overflow-hidden border border-white/25">
                                        <input type="file" name="closeUpPhoto"
                                            class="p-3 file:absolute file:-top-[2px] file:-right-2 file:px-6  file:text-white file:bg-blue-500 file:border-0 file:h-[50px]" />
                                    </div>
                                </div>

                                @if ($user->status == 'noactived')
                                    <button class="bg-orange p-3 rounded-lg w-full text-black mt-2">Submit
                                        Verification</button>
                                @endif

                            </form>
                            <p class="mt-6">Please upload only jpg, png, gif files. Maximum upload size is 1 MB.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[45%]">
            <div class="overflow-hidden ">
                <div class="bg-black rounded-lg">
                    <div class="p-6 text-white/70 border-b border-white/25">
                        <p>Profile</p>
                    </div>

                    @if ($user->status == 'actived')
                        @include('components.verified', [
                            'label' => 'Account is active',
                            'description' => 'You have successfully activated your account',
                        ])
                    @else
                        @include('components.unverified', ['label' => ''])
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
