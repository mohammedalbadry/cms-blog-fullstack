@extends('cpanal.layouts.app')

@section('title', $title)

@section('content')

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$users}}</h3>

              <p>المستخدمين</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{aurl('user')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$comments}}</h3>

              <p>التعليقات</p>
            </div>
            <div class="icon">
              <i class="fas fa-comments"></i>
            </div>
            <a href="{{aurl('comment')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$posts}}</h3>

              <p>التدوينات</p>
            </div>
            <div class="icon">
              <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{aurl('post')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$reports}}</h3>

              <p>البلاغات</p>
            </div>
            <div class="icon">
              <i class="fas fa-ban"></i>
            </div>
            <a href="{{aurl('report')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3">
                <i class="fas fa-chart-area mr-1"></i>
                الزيارات
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">

                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                </div>
 
              </div>
            </div><!-- /.card-body -->
          </div>

        </section>
      </div>

    </div><!-- /.container-fluid -->
  </section>

@endsection