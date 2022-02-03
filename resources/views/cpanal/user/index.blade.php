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
                    <form action="{{aurl('users')}}" method="get">
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
                        <th>المستخدم</th>
                        <th>البريد الاكترونى</th>
                        <th>الأجراءات</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index=>$model)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img class="admin_img_td" src="{{$model->image_path}}" alt="{{$model->name}}">{{$model->name}}</td>
                            <td>{{$model->email}}</</td>
                            <td>

                                @if($model->banned_status == 0)
                                    <button class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#modal-default{{$model->id}}">حظر <i class="fas fa-ban"></i></button> 
                                    <div class="modal fade" id="modal-default{{$model->id}}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title"> حظر المستخدم</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <p>هل انت متاكد من حظر {{$model->name}}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <form method="post" action="{{aurl("users/".$model->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">تاكيد الحظر</button>
                                            </form>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @else
                                    <button class="btn btn-success  btn-sm" data-toggle="modal" data-target="#modal-default{{$model->id}}">الغاء الحظر <i class="fas fa-unlock"></i></button> 
                                    <div class="modal fade" id="modal-default{{$model->id}}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title"> الغاء الحظر </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <p>هل انت متاكد من الغاء حظر {{$model->name}}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <form method="post" action="{{aurl("users/".$model->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"> الغاء الحظر</button>
                                            </form>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @endif
                                
  
                            </td> 
                          </tr> 
                        @endforeach 
                    </tbody>
                  </table>
                  {{ $data->appends(request()->query())->links() }}
                @else
                  <h3 class="alert alert-primary text-center">لا يوجد مستخدمين</h3>
                @endif
              </div>
  
          </div>
        </div>
    </div>
</section>


@endsection