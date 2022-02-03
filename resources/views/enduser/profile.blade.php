<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>الملف الشخصي</title>
  <link rel="icon" href="{{ $setting->icon_path }}">
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
    .live_img{
      width: 80px;
      height: 80px;
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <p> الملف الشخصي</p>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      @include('enduser.partials.message')
      <form action="{{ url('profile') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group text-center">
            <div class="input-group">
              <div class="custom-file">
                <label class="custom-file-label" for="exampleInputFile">اختر صورة</label>
                <input type="file" name='image' class="custom-file-input input_live_img" id="exampleInputFile">
              </div>
            </div>
            <img class="live_img mt-1" src="{{ $user->image_path }}">
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="الاسم" value="{{$user->name}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="البريد الالكترونى" value="{{$user->email}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="كلمة السر">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="اعد كلمة السر">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">حفظ التغيرات</button>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<!-- jQuery -->
<script src="{{asset('/cpanal')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/cpanal')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).on('change', ".input_live_img", function() {

    if (this.files && this.files[0]) {

      
      var reader = new FileReader();

      
      var src = $(this).parents('.form-group').find(".live_img");
      
      reader.onload = function(e) {
        src.attr('src', e.target.result);
      }
      
      reader.readAsDataURL(this.files[0]); // convert to base64 string
    }
  });
</script>

</body>
</html>
