<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title' , 'الرئيسية')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="{{ $setting->icon_path }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/cpanal')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/cpanal')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/cpanal')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap 4 RTL -->
  <link rel="stylesheet" href="{{asset('/cpanal')}}/plugins/bootstrap-4.0.0-rtl-dist/css/bootstrap.min.css">
  <!-- Custom style for RTL -->
  <link rel="stylesheet" href="{{asset('/cpanal')}}/dist/css/custom.css">
  <link rel="stylesheet" href="{{asset('/cpanal')}}/plugins/select2/dist/css/select2.min.css">


  <style>
    .live_img{
        width: 100px;
        margin:10px 0
    }
    .admin_img_td{
        height: 30px;
        margin-left: 10px;
    }
    .drop-min-width{
      min-width: 300px;     
    }
    .notifications-body{
      max-height: 235px;
      overflow-y: auto
    }
    .badge{
        font-size: .6rem;
        padding: 0.20em .4em;
    }
    .unread{
      background: #dfdfdf;
      transition: all .3s ease
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('cpanal.partials.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cpanal.partials.side')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('cpanal.partials.footer')


<!-- jQuery -->
<script src="{{asset('/cpanal')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/cpanal')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="{{asset('/cpanal')}}/plugins/bootstrap-4.0.0-rtl-dist/js//bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/cpanal')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/cpanal')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/cpanal')}}/dist/js/adminlte.js"></script>
<script src="{{asset('/cpanal')}}/dist/js/custom.js"></script>
<script src="{{asset('/cpanal')}}/plugins/select2/dist/js/select2.min.js"></script>
<script src="{{asset('/cpanal')}}/plugins/ckeditor/ckeditor.js"></script>

<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

<script>
  var options = {
    filebrowserImageBrowseUrl: '{!! aurl('images-media') !!}',
    filebrowserImageUploadUrl: '{!! aurl('images-media') !!}',
    filebrowserBrowseUrl: '{!! aurl('images-media') !!}',
    filebrowserUploadUrl: '{!! aurl('images-media') !!}',
    toolbarGroups:  [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ],
    removeButtons: 'Source,NewPage,ExportPdf,Preview,Print,Save,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Replace,Find,SelectAll,Scayt,Form,Checkbox,TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CopyFormatting,Flash,SpecialChar,About,Language,Anchor,Unlink,Radio,ShowBlocks,CreateDiv,Superscript,Subscript'
  };
 
  if ( ($("#editor").length > 0)){
    CKEDITOR.replace('editor', options);
  }
</script>
<script>
    var route_prefix = '{!! aurl('images-media') !!}';
    $('#lfm').filemanager('*', {prefix: route_prefix});   
</script>
<script>
  var url =  '{{ aurl('markAsRead') }}';
  $('.notifications-btn').on('click', function() {
    $(".notifications-dropdown").toggleClass("show");
    $.get(url, function(res,status){
     if(status == "success"){
        $('.notifications-badge').hide();
        window.setTimeout(function () {
          $('.notifications-count').text("0");
        }, 5000);
     }
    });
  });
</script>
@if(isset($visitos_days) && isset($visitos_views))
  @include('cpanal.partials.chart')
@endif
</body>
</html>
