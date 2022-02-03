@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="card-body pad card card-outline card-info">

    <form role="form" method="post" action="{{aurl('pages')}}" enctype="multipart/form-data">
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
            <textarea id="editor" name="body" class="form-control">{!! old('content') !!}</textarea>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body card card-outline card-info">

            <div class="form-group">
              <label for="exampleInputFile">الصوره الرئيسية</label>
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="image">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;">
                <img style="margin-top:15px;max-height:100px;" src="{{ asset('uploads/page_images/default.png') }}">
              </div>
          </div> 
          
          <div class="form-group">
            <label for="slug">الرابط الدائم</label>
            <input name="slug" value="{{old('slug')}}" type="text" class="form-control" placeholder="رابط الصفحه ">
          </div>

            <div class="form-group">
              <label>نبذه</label>
              <textarea class="form-control" name="excerpt"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
              <label>التعليقات</label>
              <select name="comments" class="form-control">
                <option value="allow">مفعل</option>
                <option value="notallow">متوقف</option>
              </select>
            </div>

            <div class="form-group">
              <label>الظهور</label>
              <select name="visibility" class="form-control">
                <option value="public">عام</option>
                <option value="private">خاص</option>
              </select>
            </div>

            <div class="form-group">
              <label>الحاله</label>
              <select name="publish" class="form-control">
                <option value="publish">نشر</option>
                <option value="waiting">مسوده</option>
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


