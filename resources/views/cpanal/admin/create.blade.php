@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="card-body pad card card-outline card-info">

            @include('cpanal.partials.message')
              <form role="form" method="post" action="{{aurl('admins')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="اسم المشرف">
                </div>

                <div class="form-group">
                    <label for="email">الاميل</label>
                    <input name="email" value="{{old('email')}}" type="email" class="form-control" placeholder="اميل المشرف">
                </div>

                <div class="form-group">
                    <label for="password">كلمة السر</label>
                    <input name="password" type="password" class="form-control" placeholder="كلمة السر">
                </div>

                <div class="form-group">
                    <label for="password"> تاكيد كلمة السر</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="تاكيد كلمة السر">
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">صورة المشرف</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <input type="file" name='image' class="custom-file-input input_live_img" id="exampleInputFile">
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">اختر صورة</span>
                      </div>
                    </div>
                    <img class="live_img" src="{{ asset('uploads/admins_images/default.png') }}">
                </div>
                
                <div class="form-group">
                    <label>الصلاحيات</label>
                    <select name="role" class="form-control">
                      <option value="admin">ادمن</option>
                      <option value="super_admin">سوبر ادمن</option>
                    </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-dark">اضف الان</button>
                </div>
              </form>

          </div>
        </div>
      </div>
  </div>
</section>

@endsection


