@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Setting',
        'path' => ['Setting', 'Profile Photo'],
    ])

    <section class="my-6 w-full flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-2/4 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Profile Photo</p>
            </div>
            <div class="text-white/70 p-6 text-sm">
                <p>This page allows you to upload a personal photo to your profile.</p>
                <p class="my-4">Photo Requirements</p>
                <ul class="list-disc ml-10">
                    <li>Allowed image file formats: jpg, jpeg, png, and gif.</li>
                    <li>Image dimensions will automatically be adjusted to a maximum width of 1024 pixels.</li>
                    <li>Image file size must not exceed 1 MB.</li>
                </ul>
                <div src="" class="w-28 mt-6 h-28 bg-background bg-cover"
                    style="background-image: url({{ asset('') }}storage/photo-profile/{{ $user->profile->photoProfile }});">
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('setting.image.update') }}"
                    class=" mt-6">
                    @csrf
                    @method('PUT')

                    <label>Select Image</label><br>
                    <input type="file" class="mt-2" name="photoProfile" /><br />
                    <button class="bg-orange p-3 rounded-lg text-black mt-3 w-48">Update</button>
                </form>
                <p class="mt-4">Upload only jpg, png, or gif files. Maximum size is 1 MB.</p>
            </div>
    </section>
@endsection
