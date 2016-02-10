<div class="form-group">
    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-4 control-label'] ) !!}
    <div class="col-md-6">
        {!! Form::text('email') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password', 'New Password:', ['class' => 'col-md-4 control-label'] ) !!}
    <div class="col-md-6">
        {!! Form::password('password') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-4 control-label'] ) !!}
    <div class="col-md-6">
        {!! Form::password('password_confirmation') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-10">
        {!! Form::hidden('token', $token) !!}
        {!! Form::submit('Reset password', ['class'=>'btn primary']) !!}
    </div>
</div>
