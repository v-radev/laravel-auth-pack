<div class="form-group row">
    <div class="col-md-10">
        {!! Form::label('username', 'Username:', ['class' => 'control-label'] ) !!}
        <p style="color: #888">Can contain only lowercase letters, numbers, underscore and period.</p>
    </div>
    <div class="col-md-10">
        {!! Form::text('username') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::text('email') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10">
        {!! Form::label('name', 'Name:', ['class' => 'control-label'] ) !!}
        <p style="color: #888">Can contain only letters, space, dash, apostrophe and period.</p>
    </div>
    <div class="col-md-10">
        {!! Form::text('name') !!}
    </div>
</div>
<div class="form-group row">

    {!! Form::label('password', 'Password:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::password('password') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::password('password_confirmation') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10">
        {!! Form::submit('Register', ['class'=>'btn primary']) !!}
    </div>
</div>
