@include('template.home_header')
<body class="login-bg"> 
<!-- Login header start -->
<div class="login-logo"></div>
<!-- header end -->
<section class="full-wrapper common-padding login-section">
    <div class="container">
        <div class="text-center">
            <h2>Welcome To  Arizona National Software</h2>
        </div>

      
        <div class="login-form">

       
        <form method="POST" action="{{ route('login') }}">
                        @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="your@email.com" name="email" value="{{ old('email') }}" required autofocus/>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('email') }}</strong>
                     </span>
                 @endif
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="******" name="password" required>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                  </span>
                 @endif
            </div>
            <div class="form-group d-flex justify-content-between align-items-center">
                <div class="ch-checkbox"> 
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>

                </div>
                <div class="forget-password">
                    <a href="#">Forget Password</a>
                </div>
            </div>

            <div class="form-group login-button">
                <button type="submit" class="btn submit-btn">
                                    {{ __('Login') }}
                          </button>
            </div>
            <!-- div class="text-center login-bottom-text">
                <p>Don’t have an account?&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<a href="signup.html">Sign up now</a></p>
            </div -->

            </form>
        </div>  
       
    </div>
</section>
@include('template.home_footer')
