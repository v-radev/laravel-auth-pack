@extends('authcluster.layouts.dashboard')

@section('content')
    <?php $userRoleId = $userRole ? $userRole->id : ''; ?>
    <?php $userRole = $userRole ? $userRole->name : 'NO ROLE ASSIGNED'; ?>
    @include('flash::message')
    <h1 class="page-header">Edit user role and rights</h1>
    <h2 class="sub-header"><b>{{$user->username}}</b> | <span style="color: #777;">{{$userRole}}</span></h2>

    @include('authcluster._partials.common.errors')
    <div class="row">
        <div class="col-md-2">
            {!! Form::open(['route' => ['dashboard.users.update', $user->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('user_role', 'User role:') !!}
                    {!! Form::select('user_role', $roles, $userRoleId, ['id' => 'user_role']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_permissions[]', 'User permissions:') !!}
                    <select multiple="multiple" name="user_permissions[]" id="user_permissions" style="width: 250px; height: 350px;">
                        @if(count($permissions))
                            @foreach($permissions as $p)
                                <option value="{{$p->permission->id}}" @if(in_array($p->permission->id, $userPermissions))selected="selected"@endif>{{$p->permission->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::submit('Save', ['class'=>'btn primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('script')
    {!!Html::script('js/ajax-utilities.js')!!}

    <script type="text/javascript">

        var a = new Ajax(),
            requestParams = {
                type: 'POST',
                url: '{{route('dashboard.ajax')}}'
            };

        $('select#user_role').change(function(){

            var $this = $(this),
                selected = $this.find(':selected').val();

            requestParams.data = { action: 'role_permissions', role_id: selected, _token: $('input[name="_token"]').val() };

            a.send( requestParams )
                    .done(function(data){
                        var select = $('select#user_permissions').get(0),
                            response,
                            i;

                        select.options.length = 0;

                        try {
                            response = jQuery.parseJSON(data);
                        } catch (Error) {
                            alert('There was an error with the request. Please try again.');
                            return;
                        }

                        for(i = 0; i < response.length; i++) {
                            select.options.add(new Option(response[i].permission.name, response[i].permission.id))
                        }
                    });
        });//END change
    </script>
@stop