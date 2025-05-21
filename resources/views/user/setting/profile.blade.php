@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Setting',
        'path' => ['Setting', 'Profile'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Profile</p>
            </div>

            <div class="text-white p-6">
                <form action="{{ route('setting.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('components.input', [
                        'label' => 'Username',
                        'name' => 'user[username]',
                        'value' => $user->username,
                    ])

                    @include('components.input', [
                        'label' => 'Referrals',
                        'name' => 'refferal',
                        'value' => $user->username,
                    ])

                    @include('components.input', [
                        'label' => 'Full Name',
                        'name' => 'user[name]',
                        'value' => $user->name,
                    ])

                    @include('components.input', [
                        'label' => 'Address',
                        'name' => 'profile[address]',
                        'value' => $user->profile[0]->address,
                    ])

                    @include('components.input', [
                        'label' => 'Country',
                        'name' => 'user[country]',
                        'value' => $user->country,
                    ])

                    @include('components.input', [
                        'label' => 'Email Address',
                        'name' => 'user[email]',
                        'value' => $user->email,
                    ])

                    <label class="text-white/70" for="phone">Number Phone</label>
                    <div class="flex items-center">
                        <div
                            class="bg-background outline-none p-3 mb-2 border border-white/30 rounded-l-lg border-r-0 h-[46px]">
                            🇮🇩
                        </div>
                        <input type="tel" value="{{ $user->numberPhone }}" id="phone" name="phone"
                            class="text-white/50 w-full mt-2 border border-white/30 outline-none rounded-r-lg p-3 bg-black mb-4"
                            readonly>
                    </div>

                    @include('components.input', [
                        'label' => 'Bitcoin Address',
                        'name' => 'profile[bitcoinAddress]',
                        'value' => $user->profile[0]->bitcoinAddress,
                    ])

                    @include('components.input', [
                        'label' => 'Bank Name',
                        'name' => 'profile[bank]',
                        'value' => $user->profile[0]->bank,
                    ])

                    <label class="text-white/70" for="email">Notification Login</label><br />
                    <select name="profile[notificationLogin]"
                        class="bg-background outline-none p-3 mb-2 border border-white/30 w-full mt-2 rounded-lg h-[50px]">
                        <option value="1" {{ $user->profile[0]->notificationLogin == 1 ? 'selected' : '' }}>
                            Send it to me when logged in
                        </option>
                        <option value="0" {{ $user->profile[0]->notificationLogin == 0 ? 'selected' : '' }}>
                            Dont send it to me when logged in
                        </option>
                    </select>

                    <button class="bg-orange p-3 rounded-lg w-full text-black mt-2">Update</button>
                </form>
            </div>
        </div>

        <div class="w-full rounded-lg overflow-hidden bg-black" style="max-height: 450px;">
            <div class="p-6 text-white/70 border-b border-white/25" id="i">
                Change Password
            </div>

            <div class="text-white p-6" x-ref="changePasswordContainer">
                <form action="{{ route('setting.profile.update.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('components.input', [
                        'label' => 'Current Password',
                        'name' => 'user[currentPassword]',
                    ])

                    @include('components.input', [
                        'label' => 'New Password',
                        'name' => 'user[newPassword]',
                    ])

                    @include('components.input', [
                        'label' => 'Confirmation New Password',
                        'name' => 'user[confirmPassword]',
                    ])

                    <button id="button-password" class="bg-orange p-3 rounded-lg w-full text-black mt-2">Change
                        Password</button>
                </form>
            </div>
        </div>
    </section>
@endsection
