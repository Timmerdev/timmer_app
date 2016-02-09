


<!-- start of accordion -->
<div class="row top-grid">
<div class="col-md-1"><b>Time</b></div>
<div class="col-md-13">
<table class="table-responsive" style="width:90%;margin-top:-5px">
<thead>
<th class="days-list">{!! $dayBefore3['currentDayName'] !!} {!! $dayBefore3['currentMonth'] !!}/{!! $dayBefore3['currentDay'] !!}</th>
<th class="days-list">{!! $dayBefore2['currentDayName'] !!} {!! $dayBefore2['currentMonth'] !!}/{!! $dayBefore2['currentDay'] !!}</th>
<th class="days-list">{!! $dayBefore['currentDayName'] !!} {!! $dayBefore['currentMonth'] !!}/{!! $dayBefore['currentDay'] !!}</th>
<th class="days-list">{!! $targetDay['currentDayName'] !!} {!! $targetDay['currentMonth'] !!}/{!! $targetDay['currentDay'] !!}</th>
<th class="days-list">{!! $dayAfter['currentDayName'] !!} {!! $dayAfter['currentMonth'] !!}/{!! $dayAfter['currentDay'] !!}</th>
<th class="days-list">{!! $dayAfter2['currentDayName'] !!} {!! $dayAfter2['currentMonth'] !!}/{!! $dayAfter2['currentDay'] !!}</th>
<th class="days-list">{!! $dayAfter3['currentDayName'] !!} {!! $dayAfter3['currentMonth'] !!}/{!! $dayAfter3['currentDay'] !!}
<th class="days-list"><button href="#findMonth" data-toggle="modal" data-target="#myModal" class="week-grid-button" style="border:none;color:#EEEEEE;background-color:#EEEEEE"><img src="{{ asset('images/add.png')}}" class= 'side-icon' alt="Add New Log" /></button> &nbsp;&nbsp;&nbsp;&nbsp; <a href="#editList" data-url="/getEditList"><img src="{{ asset('images/edit.png')}}" class='side-icon' alt="Edit Today's List" /></a> </th>
<th>
</thead>
</table>
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

</div>
</div>

  
