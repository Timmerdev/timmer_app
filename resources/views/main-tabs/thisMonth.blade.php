
@extends('pages.land')

@section('tab')
<div class="btn-group btn-group-justified">
<!-- start of top row for buttons-->
<div class="btn-group" role="group"><a href="{{ url('beforeMonth/'.$monthBefore.'/'.$beforeYear)}}" class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon inverted' alt="Move to next Day" /></a></div>

 <div class="btn-group" role="group"><a href="{{ url('thisMonth')}}" data-url="/getToday"class="btn btn-lg side-button"><img src="{{ asset('images/home.png')}}" class='side-icon' alt="Back to Current List" /></a></div>

 <div class="btn-group" role="group"><button href="#findMonth" data-toggle="modal" data-target="#myModal" class="btn btn-lg side-button find"><img src="{{ asset('images/find.png')}}" class='side-icon' alt="Find Date" /></button></div>

<div class="btn-group" role="group"><a href="{{ url('nextMonth/'.$monthAfter.'/'.$afterYear) }} " class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon' alt="Move to next Day" /></a></div>
 <!-- end of top row buttons -->
</div>

	@include('includes.searchDate')
<div class="layout-content-month" style="margin-top:15px">
   @include('month-layout.month')
  </div>


@stop

