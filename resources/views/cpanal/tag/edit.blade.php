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
              <form role="form" method="post" action="{{aurl('tags/'. $model->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input name="name" value="{{$model->name}}" type="text" class="form-control" placeholder="اسم المشرف">
                </div>

                <div class="form-group">
                    <label for="slug">الاسم الطيف</label>
                    <input name="slug" value="{{$model->slug}}" type="text" class="form-control" placeholder="اسم الطيف">
                </div>

                <div class="form-group">
                  <label>وصف</label>
                  <textarea class="form-control" name="description"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{$model->description}}</textarea>
                </div>

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


