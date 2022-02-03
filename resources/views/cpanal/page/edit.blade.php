@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="card-body pad card card-outline card-info">

    <form role="form" method="post" action="{{aurl('pages/'. $model->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-12">
          @include('cpanal.partials.message')
            <div class="form-group">
              <label for="title">العنوان</label>
              <input name="title" value="{{$model->title}}" type="text" class="form-control" placeholder="العنوان ">
            </div>
        </div>
        <div class="col-md-8">
          <div class="card-body card card-outline card-info">
            <textarea id="editor" name="body" class="form-control">{!! $model->body !!}</textarea>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body card card-outline card-info">

            <div class="form-group">
              <label for="exampleInputFile">الصوره الرئيسيه</label>
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="image">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;">
                <img style="margin-top:15px;max-height:100px;" src="{{ $model->image }}">
              </div>
          </div>
          
          <div class="form-group">
            <label for="slug">الرابط الدائم</label>
          <input name="slug" value="{{ $model->slug }}" type="text" class="form-control" placeholder="رابط الصفحه ">
          </div>

            <div class="form-group">
              <label>نبذه</label>
              <textarea class="form-control" name="excerpt"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{ $model->excerpt }}</textarea>
            </div>

            <div class="form-group">
                <label>التعليقات</label>
                <select name="comments" class="form-control">
                  <option value="allow" {{ $model->comments == "allow" ? "selected" : " " }}>مفعل</option>
                  <option value="notallow" {{ $model->comments == "notallow" ? "selected" : " " }}>متوقف</option>
                </select>
              </div>
  
              <div class="form-group">
                <label>الظهور</label>
                <select name="visibility" class="form-control">
                  <option value="public" {{ $model->visibility == "public" ? "selected" : " " }}>عام</option>
                  <option value="private" {{ $model->visibility == "private" ? "selected" : " " }}>خاص</option>
                </select>
              </div>
  
              <div class="form-group">
                <label>الحاله</label>
                <select name="publish" class="form-control">
                  <option value="publish" {{ $model->publish == "publish" ? "selected" : " " }}>نشر</option>
                  <option value="waiting" {{ $model->publish == "waiting" ? "selected" : " " }}>مسوده</option>
                </select>
              </div>
            

          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-dark">حدث الان</button>
      </div>
    </form>

  </div>
</section>

@endsection


