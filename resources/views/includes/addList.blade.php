<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Search Date</h4>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'addList', 'data-parsley-validate' ] ) !!}
               
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