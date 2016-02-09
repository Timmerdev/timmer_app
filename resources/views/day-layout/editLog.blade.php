<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-8">
<h2>Edit Log:</h2><br>
{!! Form::open(['url'=>'/addauthor', 'class' => 'col s6 offset-s3']) !!}
<div class="row">
    <div class="col-md-6">
          <div class="form-group">
            <label for="log_name" class="control-label">Log Name:</label>
            {!! Form::text('log_name', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'Eat Lunch',
            'required',
            'id'                            => 'log_name'
        ]) !!}
          </div><br>
          <div class="form-group">
            <label for="log_description" class="control-label">Description (Optional):</label>
            {!! Form::text('log_description', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'Lunch is the best',
            'id'                            => 'log_description'
        ]) !!}
          </div><br>
          <div class="form-group">
            <label for="datepicker" class="control-label">Date (Optional):</label>
            {!! Form::text('date', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '12/27/2089',
            'id'                            => 'datepicker'
        ]) !!}
          </div>
    </div>
        <div class="col-md-6">
        <div class="form-group">
        <strong>Duration (Optional / 30 min. default time):</strong><br><br>
            <label for="min2" class="control-label">Minutes</label>
            {!! Form::text('min2', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '47',
            'id'                            => 'min2'
        ]) !!}
            <div id="slider-range-min4" style="margin-top:7px"></div>
          <br>
            <label for="hour2" class="control-label">Hours</label>
            {!! Form::text('hour2', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '1',
            'id'                            => 'hour2'
        ]) !!}
            <div id="slider-range-min3" style="margin-top:7px"></div>
        </div>
          <div class="form-group">
          <label for="priority" class="control-label">Priority:</label>
          <div class="row"> 
              <div class="col-md-4">{!! Form::radio('priority', 'low', true) !!} Low</div>
              <div class="col-md-4">{!! Form::radio('priority', 'medium') !!} Medium</div>
              <div class="col-md-4">{!! Form::radio('priority', 'high') !!} High</div>
             </div>
          </div>
    </div>
    </div>
          <br>
          <div class = "row">
          <div class="col-md-6">
          <a href ="{{ url('/*') }}"  class="btn btn-lg btn-default btn-block">Cancel</a>
          </div>
          <div class="col-md-6">
          <button type="button" class="btn btn-lg btn-primary btn-block">Apply Changes</button>
          </div>
          </div>
    {!! Form::close() !!}
</div>
<div class="col-md-2">
</div>
</div>