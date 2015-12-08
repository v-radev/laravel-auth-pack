<div class="form-group">
    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-4 control-label'] ) !!}
    <div class="col-md-6">
        {!! Form::text('email') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::submit('Send Password Reset Link', ['class'=>'btn primary']) !!}
</div>

