
<head>
    <link rel="stylesheet" href="css/register.css">
</head>
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="name" placeholder="Username" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="number" name="phone" placeholder="phone" value="{{ old('phone') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                        <button type="submit">
                            Sign up
                        </button>
                    </form>
                    <p>
                        <span>Already have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign in here</b>
                    </p>
                </div>
            </div>
        </div>
        <!-- END SIGN UP -->
        
        <!-- SIGN IN -->
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit">
                            Sign in
                        </button>
                    </form>
                    <p>
                        <b>Forgot password?</b>
                    </p>
                    <p>
                        <span>Don't have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign up here</b>
                    </p>
                </div>
            </div>
        </div>
        <!-- END SIGN IN -->
    </div>
    <!-- END FORM SECTION -->
    
    <!-- CONTENT SECTION -->
    <div class="row content-row">
        <!-- SIGN IN CONTENT -->
        <div class="col align-items-center flex-col">
            <div class="text sign-in">
                <h2>Welcome</h2>
            </div>
            <div class="img sign-in"></div>
        </div>
        <!-- END SIGN IN CONTENT -->
        
        <!-- SIGN UP CONTENT -->
        <div class="col align-items-center flex-col">
            <div class="img sign-up"></div>
            <div class="text sign-up">
                <h2>Join with us</h2>
            </div>
        </div>
        <!-- END SIGN UP CONTENT -->
    </div>
    <!-- END CONTENT SECTION -->
</div>
<script src="js/main.js"></script>


