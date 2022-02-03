@extends('cpanal.layouts.app')

@section('title', 'الوسائط')

@section('content')

<div style="margin: 15px">
    <iframe src="{{aurl('images-media')}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</div>

@endsection