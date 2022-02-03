@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')


<section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="card card-outline table-responsive card-info">
            <!-- /.card-header -->
              <div class="card-header">
                <div class="row">
                  <div class="col-md-5">
                    <form action="{{aurl('pages')}}" method="get">
                        <div class="input-group">
                        <input name="search" value="{{request()->search}}" type="text" class="form-control" placeholder="بحث">
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-info btn-flat">بحث <i class="fas fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @include('cpanal.partials.message')
                @if ($data->count() > 0)
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>العنوان</th>
                        <th>الرابط الدائم</th>
                        <th>الأجراءات</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index=>$model)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{$model->title}}</td>
                            <th>{{$model->slug}}</th>
                            <td>
                              <a  class="btn btn-primary btn-sm" href="{{aurl('pages/'. $model->id .'/edit')}}">تعديل <i class="fa fa-edit"></i></a>
                              <button class="btn btn-danger btn-sm disabled" data-toggle="modal" data-target="#modal-default{{$model->id}}">حذف <i class="fa fa-trash-alt"></i></button>
                              
                              <div class="modal fade" id="modal-default{{$model->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">حذف الصفحة</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      
                                      <div class="alert alert-danger" role="alert">
                                        لاسباب متعلقة بالحمايه تم ايقاف هذة الميزة
                                      </div>
                                      <p class="d-none">هل انت متاكد من حذف <strong>{{$model->title}}</strong></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <form method="post" action="{{aurl("pages/".$model->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger disabled">تاكيد الحذف</button>
                                      </form>
                                      <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
  
                            </td> 
                          </tr> 
                        @endforeach 
                    </tbody>
                  </table>
                  {{ $data->appends(request()->query())->links() }}
                @else
                  <h3 class="alert alert-primary text-center">لا يوجد صفحات</h3>
                @endif
              </div>
  
          </div>
        </div>
    </div>
</section>


@endsection