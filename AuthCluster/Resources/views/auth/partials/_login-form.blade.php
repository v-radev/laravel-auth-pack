<div class="form-group">
    {!! Form::label('username', 'Username:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('username') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('remember', 'Remember me:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('remember') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-10">
        {!! Form::submit('Login', ['class'=>'btn primary']) !!}
    </div>
</div>
<div class="col-md-10">
    <br/>
    <a href="{{ route($authLoginRoutes . 'password') }}">Forgot Your Password?</a>
</div>
