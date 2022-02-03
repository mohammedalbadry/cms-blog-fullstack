@extends('enduser.layouts.app')

@section('meta')
@include('meta::manager', [
		'title'         => 'اتصل بنا',
		'description'   => $setting->description,

	])
@endsection


@section('content')

<div class="pc-scale">
    <div class="container p-t-4 p-b-40 mt-4">
        <h2 class="f1-l-1 cl2 text-center">
           اتصل  بنا
        </h2>
    </div>
    
    <!-- Post -->
    <section class="bg0 p-b-55 mb-5">
        <div class="container">
            
    
            <div class="m-auto" style="max-width: 580px">
    
                <form method="POST" action="{{url('/contact')}}">
                    @csrf  
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="الاسم">
          
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="البريد الاكترونى">
          
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="title" class="form-control" placeholder="عنوان الرسالة">
          
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-edit"></i></span>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <textarea class="form-control" name="subject" placeholder="محتوى الرسالة ..."></textarea>
                    </div>
    
                    <button type="submit" class="btn btn-block btn-primary">ارسال</button>
                </form>
    
            </div>
    
    
        </div>
    </section>
</div>

@endsection