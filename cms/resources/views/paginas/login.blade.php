<body class="login-page" style="min-height: 512.8px;">
  <div class="container h-100">
    <div class="row justify-content-center align-items-center minh-100">
      <div class="login-box">
        <div class="login-logo">
          Blog del viajero
        </div>
        <!-- /.login-logo -->
        <div class="card shadow">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
      
            <form method="POST" action="{{ route('login') }}">
              @csrf
    
              <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control email_login @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
    
              <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
    
              <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                          <label class="form-check-label" for="remember">
                              {{ __('Remember Me') }}
                          </label>
                      </div>
                  </div>
              </div>
    
              <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Login') }}
                      </button>
    
                      @if (Route::has('password.request'))
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              {{ __('Forgot Your Password?') }}
                          </a>
                      @endif
                  </div>
              </div>
          </form>
      
            
      
            
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>

  <script src="{{url('/')}}/js/login.js"></script>

  </body>