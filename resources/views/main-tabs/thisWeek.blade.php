
@extends('pages.land')

@section('tab')
<div class="btn-group btn-group-justified" style = "width:95%">
<div class="btn-group" role="group"><a href="{{ url('weekBefore/'.$weekYearBefore.'/'.$weekMonthBefore.'/'.$weekDayBefore) }}" class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon inverted' alt="Move to next Day" /></a></div>
<div class="btn-group" role="group">
<a href="{{ url('week') }}" class="btn btn-lg side-button"><img src="{{ asset('images/home.png')}}" class='side-icon' alt="Back to Current Week" /></a></ul>
</div>
<div class="btn-group" role="group"><a href="{{ url('weekAfter/'.$weekYearAfter.'/'.$weekMonthAfter.'/'.$weekDayAfter) }}" class="btn btn-lg side-button"><img src="{{ asset('images/next.png')}}" class='side-icon' alt="Move to next Week" /></a></div>
</div>
@include('includes.addList')
<div class="layout-content-month" style="margin-top:15px">
 @include('week-layout.week')
  </div>



@stop

