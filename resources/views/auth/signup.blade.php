@extends('_layout.auth')

@section('content')
    <section class="fxt-template-animation fxt-template-layout28">
        <!-- Animation Start Here -->
        <div id="particles-js"></div>
        <!-- Animation End Here -->

        <div class="fxt-content">
            <div class="fxt-header" style="margin-top:-30px;">
                <a href="index.php.html" class="fxt-logo" style="margin-bottom:25px;">
                    <img src="{{ asset('') }}images/logo.png" alt="Logo" style="width: 180px" />
                </a>

                <ul class="fxt-switcher-wrap">
                    <li><a href="{{ route('auth.signin') }}" class="switcher-text">Login</a></li>
                    <li><a href="{{ route('auth.signup') }}" class="switcher-text active">Register</a></li>
                    <li><a href="{{ route('auth.forget') }}" class="switcher-text">Forgot Password</a></li>
                </ul>
            </div>

            <div class="fxt-form">
                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <p>Register New Member</p>
                    <form action="{{ route('auth.signup.post') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <label class="control-label">Sponsor</label>
                                <input class="form-control" value="{{ @$sponsor }}" name="invitedBy" type="text"
                                    readonly>
                            </div>
                        </div>

                        <input type="hidden" name="inviting" value="{{ $inviting }}" />

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <label class="control-label">Name</label>
                                <input class="form-control" placeholder="Enter Full Name" required name="name"
                                    type="text" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control" placeholder="Enter WhatsApp Number" required name="phone"
                                    type="text" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <label class="control-label">Email Address</label>
                                <input class="form-control" placeholder="Enter Email" required name="email" type="email"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <label class="control-label">Username</label>
                                <input class="form-control" placeholder="Enter Username" required name="username"
                                    type="text" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-3">
                                <label class="control-label">Password</label>
                                <input class="form-control" placeholder="Enter Password" required name="password"
                                    type="password" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-3">
                                <label class="control-label">Confirm Password</label>
                                <input class="form-control" placeholder="Confirm Password" required
                                    name="password_confirmation" type="password" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-4">
                                <div class="fxt-content-between">
                                    <button type="submit" class="fxt-btn-fill">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="fxt-footer">
                <ul class="fxt-socials">
                    <li class="fxt-facebook"><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="fxt-twitter"><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="fxt-google"><a href="#" title="Google"><i class="fab fa-google-plus-g"></i></a></li>
                    <li class="fxt-linkedin"><a href="#" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="fxt-pinterest"><a href="#" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
