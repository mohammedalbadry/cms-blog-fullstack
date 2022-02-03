<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{ $setting->icon_path }}">
  <title>اعادة تعيد كلمه السر</title>
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
    .t-color{
        background-color: #1DA1F2;
        color: #fff;
    }
    .fb-color:hover,
    .g-color:hover,
    .t-color:hover{
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
    <p>اعاده تعين كلمة السر</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="البريد الالكترونى">
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
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة السر">
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

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="اعد كلمة السر">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-flat">ارسال</button>
      </form>
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
