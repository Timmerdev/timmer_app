<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">New Log</h4>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'addLog', 'data-parsley-validate' ] ) !!}
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
            'id'                            => 'datepicker'
        ]) !!}

         {!! Form::hidden('realLogDate',null,
                                ['id'                           => 'altDate'
                                ]) !!}
          </div>
    </div>
        <div class="col-md-6">
        <div class="form-group">
        <strong>Duration (Optional / 30 min. default time):</strong><br><br>
            <label for="min1" class="control-label">Minutes</label>
            {!! Form::text('min1', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '47',
            'id'                            => 'min1'
        ]) !!}
            <div id="slider-range-min2" style="margin-top:7px"></div>
          <br>
            <label for="hour1" class="control-label">Hours</label>
            {!! Form::text('hour1', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '1',
            'id'                            => 'hour1'
        ]) !!}
            <div id="slider-range-min1" style="margin-top:7px"></div>
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
                  
                <div class="modal-footer">
                   <div class = "row">
          <div class="col-md-6">
          <a href ="{{ url('/*') }}"  class="btn btn-lg btn-default btn-block">Cancel</a>
          </div>
          <div class="col-md-6">
          <button type="submit" class="btn btn-lg btn-primary btn-block">Create</button>
          </div>
          </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>