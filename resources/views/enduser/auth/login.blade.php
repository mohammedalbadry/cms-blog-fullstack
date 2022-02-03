<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{ $setting->icon_path }}">
  <title>تسجيل الدخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/enduser')}}/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('/enduser')}}/fonts/iconic/css/material-design-iconic-font.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/enduser')}}/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    html{
      direction: rtl
    }
    .login-card-body .input-group .form-control,
    .register-card-body .input-group .form-control {
      border: 1px solid #ccc;
      border-left: 0;
      border-radius: .25rem;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }
    .login-card-body .input-group .form-control:focus,
    .register-card-body .input-group .form-control:focus {
      border-color: #66afe9      
    }
    .login-card-body .input-group .input-group-text,
    .register-card-body .input-group .input-group-text {
        border: 1px solid #ccc;
        border-right: 0;
        border-radius: 0 !important;
        border-top-left-radius: .25rem !important;
        border-bottom-left-radius: .25rem !important;
    }
    .fb-color{
        background-color: #4267B2;
        color: #fff;
    }
    .g-color{
        background-color: #DB4437;
        color: #fff;
    }
    .fb-color:hover,
    .g-color:hover{
        opacity: .9;
        color: #fff;
    }
    .login-card-body .input-group .form-control.is-invalid,
    .register-card-body .input-group .form-control.is-invalid {
      border-color: #dc3545      
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p>تسجيل الدخول</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="البريد الاكترونى">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="كلمة السر">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل</button>
      </form>

      <p class="mb-1 mt-2 text-center">
        <a href="{{ route('password.request') }}">هل نسيت كلمة السر؟</a>
      </p>

      <div class="social-auth-links text-center mb-3">
        <p>- او من خلال -</p>
        <a href="{{url('login/facebook')}}" class="btn btn-block fb-color">
          <i class="fab fa-facebook mr-2"></i> سجل بستخدام فيسبوك
        </a>
        <a href="{{url('login/google')}}" class="btn btn-block g-color">
          <i class="fab fa-google mr-2"></i> سجل بستخدام جوجل
        </a>
      </div>
      <!-- /.social-auth-links -->
      <p class="mb-0 text-center">
        <a href="{{url('/register')}}" class="text-center">انشاء حساب جديد</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="{{asset('/enduser')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/enduser')}}/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
