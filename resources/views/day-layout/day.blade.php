<div class="row top-grid">
<div class="col-md-2"><b>Time</b></div>
<div class="col-md-10">

<div class="row">

<div class = "col-md-10"><b>{!! $dayName !!}, {!! $monthName !!} {!! $day !!}, {!! $year !!}</b></div>
<div class="col-md-2"><button href="#findMonth" data-toggle="modal" data-target="#myModal" class="week-grid-button" style="border:none;color:#EEEEEE;background-color:#EEEEEE"><img src="{{ asset('images/add.png')}}" class= 'side-icon' alt="Add New Log" /></button> &nbsp;&nbsp;&nbsp;&nbsp; <a href="#editList" data-url="/getEditList"><img src="{{ asset('images/edit.png')}}" class='side-icon' alt="Edit Today's List" /></a> </div>
</div>


</div>
</div>
<div class="row week-grid">
<div class="col-md-1">

<table class="table hour-mark">
<tr><td class="hour-mark-cell">12 AM</td></tr>
<tr><td class="hour-mark-cell"</td></tr>
@for ($i=1; $i < 12; $i++)
<tr><td class="hour-mark-cell">{{ $i }} AM</td></tr>
<tr><td class="hour-mark-cell"</td></tr>
@endfor
<tr><td class="hour-mark-cell">12 PM</td></tr>
<tr><td class="hour-mark-cell"</td></tr>
@for ($i=1; $i < 12; $i++)
<tr><td class="hour-mark-cell">{{ $i }} PM</td></tr>
<tr><td class="hour-mark-cell"</td></tr>
@endfor

</table>
</div>
<div class="col-md-11">



@if(is_null($logsData))
<div>
        <table class = "table">
        <tr>
        <td>wee</td>
        <td>woo</td>
        <td>waa</td>
        <td>weh</td>
        <td>hoo</td>
        </tr>
        </table>
</div>
@endif
<!-- start of accordion -->

@if(!(is_null($logsData)))


@foreach($logsData as $log)
  
          {!! $log->log_name !!}
          @if(is_null($log->log_name))
            wee
          @endif
    
        <table>
        <tr>
        <td>Description:</td><td>{!! $log->log_description !!}</td>
        <td>Duration</td><td>{!! $log->duration !!}</td>
        <td>Status</td><td>{!! $log->status !!}</td>
        <td>Group Log</td><td>{!! $log->is_group_log !!}</td>
        <td>Priority</td><td>{!! $log->priority !!}</td>
        </tr>
        </table>
     
@endforeach
</div>
@endif

</div>
</div>