<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
<h2>New List:</h2><br>
{!! Form::open(['url' => 'addList', 'data-parsley-validate' ] ) !!}

     @include('includes.errors')
          <div class="add-list-holder">
              <div class="form-group">
            <label for="getDate" class="control-label">Date (Optional):</label>
            {!! Form::text('date', null, [
            'class'                         => 'form-control',
            'placeholder'                   => '12/27/2089',
            'required',
            'id'                            => 'getDate',
            'data-parsley-required-message' => 'Date is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-pattern'          => '/^[a-zA-Z]*$/',
            'data-parsley-minlength'        => '0',
            'data-parsley-maxlength'        => '32'
        ]) !!}
            {!! Form::hidden('realdate',null,
            ['id'                           => 'alternate'
            ]) !!}
          </div>

          </div>
          <br>
          <div class = "row">
          <div class="col-md-6">
          <a href ="{{ url('/*') }}"  class="btn btn-lg btn-default btn-block">Cancel</a>
          </div>
          <div class="col-md-6">
          <button type="submit" class="btn btn-lg btn-primary btn-block">Create</button>
          </div>
          </div>
{!! Form::close() !!}
</div>
<div class="col-md-4">
</div>
</div>