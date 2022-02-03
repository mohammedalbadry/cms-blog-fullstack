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

            <a href="{{aurl('generat')}}" class="btn btn-dark btn-sm">generat sitemap</a>
            <a href="{{aurl('download')}}" class="btn btn-success btn-sm">download sitemap xml file</a>



          </div>

        </div>
      </div>
  </div>
</section>
@endsection