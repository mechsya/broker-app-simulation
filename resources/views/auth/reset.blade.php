@extends('_layout.auth')

@section('content')
    <section class="fxt-template-animation fxt-template-layout28">

        <!-- Animation Start -->
        <div id="particles-js"></div>
        <!-- Animation End -->

        <div class="fxt-content">
            <div class="fxt-form">
                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <p>Reset Your Password</p>
                </div>

                <form action="{{ route('auth.reset.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="email" value="{{ $_GET['email'] }}" />

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <input type="password" id="currentPassword" class="form-control" placeholder="Current Password"
                                required name="currentPassword" />
                            <i toggle="#currentPassword" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <input type="password" id="newPassword" class="form-control" placeholder="New Password" required
                                name="newPassword" />
                            <i toggle="#newPassword" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password"
                                required name="confirmPassword" />
                            <i toggle="#confirmPassword" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                            <div class="fxt-checkbox-area">
                                <div id="showme" style="display: none">
                                    <a href="">
                                        <button type="button" class="fxt-btn-fill">
                                            Reload
                                        </button>
                                    </a>
                                </div>

                                <div id="loadingGif" style="display: none">
                                    <img src="{{ asset('') }}login/images/ld.gif" style="width: 100px" />
                                </div>

                                <button type="submit" class="fxt-btn-fill" id="Reset" onclick="signin()">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    @if (Session::has('success'))
        <script>
            const successMessage = @json(Session::get('success'));
            Swal.fire({
                text: successMessage,
                icon: "success"
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            const errorMessage = @json(Session::get('error'));
            Swal.fire({
                text: errorMessage,
                icon: "error"
            });
        </script>
    @endif
@endsection
