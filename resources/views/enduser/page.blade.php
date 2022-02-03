@extends('enduser.layouts.app')

@section('meta')
@include('meta::manager', [
		'title'         => $page->title,
		'description'   => $setting->description,

	])
@endsection

@section('content')

<div>
    <div class="container p-t-4 p-b-40 mt-4">
        <h2 class="f1-l-1 cl2 text-center">
           {{$page->title}}
        </h2>
    </div>
    
    <!-- Post -->
    <section class="bg0 p-b-55 mb-5">
        <div class="container">
            
            <div class="m-auto" style="max-width: 580px">
                {!! $page->body !!}
            </div>

        </div>
    </section>
</div>

@endsection