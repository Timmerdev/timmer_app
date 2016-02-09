@extends('layouts.master')

@section('head')

{!! HTML::style('/assets/plugins/jquery/jquery-ui.css') !!}
{!! HTML::style('/assets/css/land.css') !!}
{!! HTML::style('/assets/css/parsley.css') !!}
{!! HTML::style('/assets/css/calendar.css') !!}
@stop

@section('content')
  
 @include('includes.status')



@stop

@section('footer')
  {!! HTML::script('/assets/plugins/jquery/jquery-ui.min.js') !!} 
    {!! HTML::script('/assets/js/landpage.js') !!}
@stop