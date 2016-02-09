
@extends('pages.land')

@section('tab')
<div class="btn-group btn-group-justified">
<!-- start of top row for buttons-->
<div class="btn-group" role="group"><a href="{{ url('dayBefore/'.$dayBefore) }}" class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon inverted' alt="Move to next Day" /></a></div>

<div class="btn-group" role="group"><a href="#listToday"class="btn btn-lg side-button"><img src="{{ asset('images/home.png')}}" class='side-icon' alt="Back to Current List" /></a></div>

<!-- <div class="btn-group" role="group"><a href="#addNewLog" data-url="/getAddNewLog" aria-controls="addNewLog" role="tab" data-toggle="tab" class="btn btn-lg side-button"><img src="{{ asset('images/add.png')}}" class= 'side-icon' alt="Add New Log" /></a></li>

<li role="presentation"><a href="#myModal" data-toggle="modal" class="btn btn-lg side-button"><img src="{{ asset('images/minus.png')}}" class='side-icon' alt="Delete List" /></a></li> -->

<div class="btn-group" role="group"><a href="{{ url('dayAfter/'.$dayAfter) }}" class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon' alt="Move to next Day" /></a></div>
 <!-- end of top row buttons -->
</div>

@include('includes.form_modal')

<div class="layout-content-month" style="margin-top:15px">
    @include('day-layout.day')
  </div>

  </div>

@stop

