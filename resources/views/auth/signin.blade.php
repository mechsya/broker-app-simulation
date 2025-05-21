@extends('_layout.auth')

@section('content')
    <section class="fxt-template-animation fxt-template-layout28">

        <!-- Animation Start Here -->
        <div id="particles-js"></div>
        <!-- Animation End Here -->

        <div class="fxt-content">
            <div class="fxt-header" style="margin-top: -30px">
                <a href="index.php.html" class="fxt-logo" style="margin-bottom: 25px">
                    <img src="{{ asset('') }}images/logo.png" alt="Logo" style="width: 180px" />
                </a>
                <ul class="fxt-switcher-wrap">
                    <li>
                        <a href="{{ route('auth.signin') }}" class="switcher-text active">Sign In</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.signup') }}" class="switcher-text">Sign Up</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.forget') }}" class="switcher-text">Forgot Password</a>
                    </li>
                </ul>
            </div>
            <div class="fxt-form">
                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <p>Sign in to your account</p>
                </div>
                <form action="{{ route('auth.signin.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <input type="text" class="form-control" placeholder="Username" required name="username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <input type="password" id="loginPassword" class="form-control" placeholder="Password" required
                                name="password" />
                            <i toggle="#loginPassword" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                            <div class="fxt-checkbox-area">

                                <div class="checkbox">
                                    <input id="rememberMe" type="checkbox" />
                                    <label for="rememberMe">Remember me</label>
                                </div>

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

                                <button type="submit" class="fxt-btn-fill" id="Login" onclick="signin()">
                                    Sign In
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
