@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
          <!-- /.card-header -->
          <div class="card-body pad">
            
            @include('cpanal.partials.message')
              <form role="form" method="post" action="{{aurl('admins/'. $model->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input name="name" value="{{$model->name}}" type="text" class="form-control" placeholder="اسم المشرف">
                </div>

                <div class="form-group">
                    <label for="email">الاميل</label>
                    <input name="email" value="{{$model->email}}" type="email" class="form-control" placeholder="اميل المشرف">
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
                  <img class="live_img" src="{{ $model->image_path}}">
                </div>
                @if (admin()->user()->hasRole('super_admin') && admin()->user()->id !== $model->id)
                <div class="form-group">
                  <label>الصلاحيات</label>
                  <select name="role" class="form-control">
                    <option value="admin" {{ $model->roles()->first()->name  == 'admin' ? 'selected' : "" }}>ادمن</option>
                    <option value="super_admin" {{ $model->roles()->first()->name == 'super_admin' ? 'selected' : "" }}>سوبر ادمن</option>
                  </select>
                </div>
                @endif
                <div class="form-group">
                  <button type="submit" class="btn btn-dark">حدث البيانات</button>
                </div>
              </form>

          </div>
        </div>
      </div>
  </div>
</section>
@endsection


