@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="card-body pad card card-outline card-info">

    <form role="form" method="post" action="{{aurl('posts')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-12">
          @include('cpanal.partials.message')
            <div class="form-group">
              <label for="title">العنوان</label>
              <input name="title" value="{{old('title')}}" type="text" class="form-control" placeholder="العنوان ">
            </div>
        </div>
        <div class="col-md-8">
          <div class="card-body card card-outline card-info">
            <textarea id="editor" name="body" class="form-control">{!! old('body') !!}</textarea>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body card card-outline card-info">

            <div class="form-group">
              <label for="exampleInputFile">الصورة الرئيسية</label>
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> اختر
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="image">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;">
                <img style="margin-top:15px;max-height:100px;" src="{{ asset('uploads/posts_images/default.png') }}">
              </div>
          </div>          

            <div class="form-group">
              <label>نبذة</label>
              <textarea class="form-control" name="excerpt"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{ old('excerpt') }}</textarea>
            </div>

            <div class="form-group">
              <label>الوسم</label>
              <select class="tags form-control" name="tags[]" multiple="multiple">
                @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
              </select>
              <a href="{{aurl("tags/create")}}" target=”_blank”> اضافة وسم جديد</a>
            </div>

            <div class="form-group">
              <label>الاقسام</label>
              <select class="categories form-control" name="categories[]" multiple="multiple">
                @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              <a href="{{aurl("categories/create")}}" target=”_blank”> اضافة قسم جديد</a>
            </div>

            <div class="form-group">
              <label>التعليقات</label>
              <select name="comments" class="form-control">
                <option value="مفعل">مفعل</option>
                <option value="متوقف">متوقف</option>
              </select>
            </div>

            <div class="form-group">
              <label>الظهور</label>
              <select name="visibility" class="form-control">
                <option value="عام">عام</option>
                <option value="خاص">خاص</option>
              </select>
            </div>

            <div class="form-group">
              <label>الحالة</label>
              <select name="publish" class="form-control">
                <option value="نشر">نشر</option>
                <option value="مسودة">مسودة</option>
              </select>
            </div>
            

          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-dark">اضف الان</button>
      </div>
    </form>

  </div>
</section>

@endsection


