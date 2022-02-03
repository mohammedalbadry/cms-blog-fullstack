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

              <form role="form" method="post" action="{{aurl('setting') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">اسم الموقع</label>
                    <input name="name" value="{{$model->name}}" type="text" class="form-control" placeholder="اسم الموقع">
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">ايقونة الموقع</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <input type="file" name='icon' class="custom-file-input input_live_img" id="exampleInputFile">
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">اختر صوره</span>
                      </div>
                    </div>
                    <img class="live_img" src="{{$model->icon_path}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">لوجو الموقع</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      <input type="file" name='logo' class="custom-file-input input_live_img" id="exampleInputFile">
                    </div>
                    <div class="input-group-append">
                       <span class="input-group-text" id="">اختر صورة</span>
                    </div>
                  </div>
                  <img class="live_img" src="{{$model->logo_path}}">
                </div>

                <div class="form-group">
                  <label>وصف الموقع</label>
                  <textarea class="form-control" name="description"  rows="3" placeholder="وصف الموقع لا يزيد عد 160 حرف">{{$model->description}}</textarea>
                </div>

                <div class="form-group">
                  <label>حالة الموقع</label>
                  <select class="form-control" name="status">
                    <option value="open" {{ $model->status  == 'open' ? 'selected' : "" }}>مفتوح</option>
                    <option value="close" {{ $model->status  == 'close' ? 'selected' : "" }}>مغلق</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>نص بديل</label>
                  <textarea class="form-control" name="alt_text" rows="3" placeholder="سيظهر هذا النص فى حاله غلق الموقع">{{ $model->alt_text }}</textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-dark">تحديث الان</button>
                </div>
              </form>

          </div>

        </div>
      </div>
  </div>
</section>
@endsection