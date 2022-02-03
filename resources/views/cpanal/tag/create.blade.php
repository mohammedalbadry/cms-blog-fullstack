@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="card-body pad card card-outline card-info">

            @include('cpanal.partials.message')
              <form role="form" method="post" action="{{aurl('tags')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="الاسم ">
                </div>

                <div class="form-group">
                    <label for="slug">الاسم الطيف</label>
                    <input name="slug" value="{{old('name')}}" type="text" class="form-control" placeholder="اسم الطيف">
                </div>

                <div class="form-group">
                  <label>وصف</label>
                  <textarea class="form-control" name="description"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{ old('description') }}</textarea>
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


