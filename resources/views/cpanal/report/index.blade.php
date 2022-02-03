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
                    <form action="{{aurl('reports')}}" method="get">
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
                        <th>التعليق</th>
                        <th>مقدم البلاغ</th>
                        <th>السبب</th>
                        <th>الحالة</th>

                        <th>الأجراءات</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index=>$model)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{$model->comment->body}}</td>
                            <td>{{$model->user->name}}</td>
                            <td>{{$model->reason}}</td>
                            <td>{{$model->status}}</td>
                            <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default{{$model->id}}">الرد <i class="fas fa-reply-all"></i></button>
                              
                              <div class="modal fade" id="modal-default{{$model->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">الرد على الابلاغ</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                      <form method="post" id="report_form" action="{{aurl("reports/".$model->id)}}">
                                        @csrf

                                        <div class="form-group">
                                          <h5>الاجراء</h5>
                                          <div class="row">
  
                                            <div class="col-sm-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_comment">
                                                <label class="form-check-label">حذف التعليق</label>
                                              </div>
                                            </div>      
                                                                 
                                            <div class="col-sm-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="block_user">
                                                <label class="form-check-label">حظر المستخدم</label>
                                              </div>
                                            </div>
                                          </div>
                              
                                        </div>
                          
                                        <div class="form-group">
                                          <label>نتيجة الفحص</label>
                                          <textarea class="form-control" name="result"  rows="3" placeholder="الرد ...">{{ $model->result }}</textarea>
                                        </div>

                                      </form>

                                      

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="submit" class="btn btn-danger" form="report_form">ارسال الرد</button>

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
                  <h3 class="alert alert-primary text-center">لا يوجد بلاغات</h3>
                @endif
              </div>
  
          </div>
        </div>
    </div>
</section>


@endsection