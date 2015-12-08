<div class="form-group row">
    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::text('email') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('name', 'Name:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::text('name') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password', 'New Password:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::password('password') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password_confirmation', 'Confirm New Password:', ['class' => 'col-md-10 control-label'] ) !!}
    <div class="col-md-10">
        {!! Form::password('password_confirmation') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10">
        {!! Form::submit('Update', ['class'=>'btn primary']) !!}
    </div>
</div>
