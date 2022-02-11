@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
  <div class="card-body pad card card-outline card-info">

    <form role="form" method="post" action="{{aurl('posts/'. $model->id)}}" enctype="multipart/form-data">
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
              <label for="exampleInputFile">الصورة الرئيسية</label>
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" value="{{old('image')}}" type="text" name="image">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;">
                <img style="margin-top:15px;max-height:100px;" src="{{ old('image',  $model->image) }}">
              </div>
          </div>          

            <div class="form-group">
              <label>نبذة</label>
              <textarea class="form-control" name="excerpt"  rows="3" placeholder="وصف لا يزيد عد 160 حرف">{{ old('excerpt', $model->excerpt) }}</textarea>
            </div>

            <div class="form-group">
              <label>الوسم</label>
              <select class="tags form-control" name="tags[]" multiple="multiple">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" 
                      {{ in_array($tag->id, $selected_tags) || is_array(old("tags")) && in_array($tag->id, old("tags"))? "selected" : " " }}>{{ $tag->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>الاقسام</label>
              <select class="categories form-control" name="categories[]" multiple="multiple">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, $selected_categories) || is_array(old("categories")) && in_array($category->id, old("categories"))? "selected" : " " }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label>التعليقات</label>
                <select name="comments" class="form-control">
                  <option value="مفعل" {{ $model->comments == "مفعل" ? "selected" : " " }}>مفعل</option>
                  <option value="متوقف" {{ $model->comments == "متوقف" ? "selected" : " " }}>متوقف</option>
                </select>
              </div>
  
              <div class="form-group">
                <label>الظهور</label>
                <select name="visibility" class="form-control">
                  <option value="عام" {{ $model->visibility == "عام" ? "selected" : " " }}>عام</option>
                  <option value="خاص" {{ $model->visibility == "خاص" ? "selected" : " " }}>خاص</option>
                </select>
              </div>
  
              <div class="form-group">
                <label>الحالة</label>
                <select name="publish" class="form-control">
                  <option value="نشر" {{ $model->publish == "نشر" ? "selected" : " " }}>نشر</option>
                  <option value="مسودة" {{ $model->publish == "مسودة" ? "selected" : " " }}>مسودة</option>
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


