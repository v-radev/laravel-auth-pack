<?php
$roleSelected = isset($_GET['roleId']) ? (int)$_GET['roleId'] : NULL;
$permissionSelected = isset($_GET['permissionId']) ? (int)$_GET['permissionId'] : NULL;
$perPageSelected = isset($_GET['perPage']) ? (int)$_GET['perPage'] : NULL;
?>
@extends('authcluster.layouts.dashboard')

@section('content')
    @include('flash::message')
    <h1 class="page-header">Users</h1>

    <div class="row">

        <div class="col-md-12">
            <!-- panel -->
            <div class="jplist-panel">
                <!-- sort -->
                <select
                        class="jplist-select"
                        data-control-type="sort-select"
                        data-control-name="sort"
                        data-control-action="sort">

                    <option data-path=".index" data-order="asc" data-type="number">Sort by</option>
                    <option data-path=".username" data-order="asc" data-type="text">Username A-Z</option>
                    <option data-path=".username" data-order="desc" data-type="text">Username Z-A</option>
                    <option data-path=".registered" data-order="asc" data-type="number">Registered Asc</option>
                    <option data-path=".registered" data-order="desc" data-type="number">Registered Desc</option>
                </select>
                <!-- filter role -->
                <select
                        class="jplist-select"
                        data-control-type="filter-select"
                        data-control-name="category-filter"
                        data-control-action="filter">

                    <option data-path="default">Filter by role</option>
                    <option data-path=".admin">Admin</option>
                    <option data-path=".moderator">Moderator</option>
                    <option data-path=".user">User</option>
                </select>
                <!-- filter permission -->
                <select
                        class="jplist-select"
                        data-control-type="filter-select"
                        data-control-name="category-filter"
                        data-control-action="filter">

                    <option data-path="default">Filter by permission</option>
                    @foreach($permissions as $p)
                        <option data-path=".{{$p->name}}">{{$p->name}}</option>
                    @endforeach
                </select>
                <!-- date picker range filter -->
                <div
                        data-control-type="date-picker-range-filter"
                        data-control-name="date-picker-range-filter"
                        data-control-action="filter"
                        data-path=".date"
                        data-datetime-format="{year}/{month}/{day}"
                        data-datepicker-func="datepicker"
                        class="jplist-date-picker-range">

                    <input type="text" class="date-picker" placeholder="Date from" data-type="prev"/>
                    <input type="text" class="date-picker" placeholder="Date to" data-type="next"/>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <!-- per page select -->
            {!! Form::open(['route' => ['dashboard.users.index'], 'method' => 'GET', 'autocomplete' => 'off']) !!}
                {!! Form::label('perPage', 'Per page:') !!}
                {!! Form::select('perPage', array_combine(range(20, 100, 20), range(20, 100, 20)), $perPageSelected, ['id' => 'perPageList']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <!-- search fields -->
            {!! Form::open(['route' => ['dashboard.users.index'], 'method' => 'GET', 'autocomplete' => 'off']) !!}
                {!! Form::label('username', 'Search by username:') !!}
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Username" />
                {!! Form::submit('Go', ['class'=>'btn primary']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-3">
            <!-- role select -->
            {!! Form::open(['route' => ['dashboard.users.index'], 'method' => 'GET', 'autocomplete' => 'off']) !!}
                {!! Form::label('roleId', 'Get all with role:') !!}
                {!! Form::select('roleId', $rolesList, $roleSelected, ['id' => 'rolesList']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-3">
            <!-- permission select -->
            {!! Form::open(['route' => ['dashboard.users.index'], 'method' => 'GET', 'autocomplete' => 'off']) !!}
                {!! Form::label('permissionId', 'Get all with permission:') !!}
                {!! Form::select('permissionId', $permissionsList, $permissionSelected, ['id' => 'permissionsList']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="itemBox">
            @foreach($users as $index => $user)
                <tr class="item">
                    <th scope="row" class="index">{{$index+1}}</th>
                    <td><a href="{{route('profile.show', [$user->username])}}" target="_blank" class="username">{{$user->username}}</a></td>
                    <?php $role = $user->role(); ?>
                    <td class="<?= $role ? $role->name : 'NO ROLE ASSIGNED'; ?>"><?= $role ? $role->name : 'NO ROLE ASSIGNED'; ?></td>
                    <td>
                        <?php $uPermissions = $user->permissions(); ?>
                        @if(count($uPermissions))
                            @foreach($uPermissions as $perm)
                                <span style="text-decoration: underline" class="{{$perm->name}}">{{$perm->name}}</span>&nbsp;&nbsp;
                            @endforeach
                        @else
                            NO PERMISSIONS ATTACHED
                        @endif
                    </td>
                    <td class="date"><?= date('Y/m/d', $user->created_at->getTimestamp()); ?></td>
                    <td>
                        <a href="{{route('dashboard.users.edit', [$user->id])}}" target="_blank">Edit</a>
                        <a href="{{route('profile.edit', [$user->username])}}" target="_blank">Profile</a>
                        @include('authcluster._partials/form/delete', ['route' => ['dashboard.users.destroy', $user->id], 'delete' => 'Delete'])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $users->render() !!}
    </div>
@stop

@section('script')
    {!! Html::script('js/jquery/jquery-ui.min.js') !!}
    {!! Html::script('js/jplist/jplist.core.min.js') !!}
    {!! Html::script('js/jplist/jplist.sort-bundle.min.js') !!}
    {!! Html::script('js/jplist/jplist.filter-dropdown-bundle.min.js') !!}
    {!! Html::script('js/jplist/jplist.jquery-ui-bundle.min.js') !!}

    <script type="text/javascript">
        $('document').ready(function(){

            var ajaxUsersUrl = '<?= route('dashboard.users.index'); ?>';

            jQuery.fn.jplist.settings = {
                datepicker: function(input, options){
                    options.dateFormat = 'yy/mm/dd';
                    input.datepicker(options);
                }
            };

            $('div.main').jplist({
                itemsBox: '.itemBox',
                itemPath: '.item',
                panelPath: '.jplist-panel'
            });

            $('input#username').autocomplete({
                source: ajaxUsersUrl,
                minLength: 3,
                select: function(event, ui) {
                    $(this).val(ui.item.value).parent('form').submit();
                }
            });

            $('select#permissionsList, select#rolesList, select#perPageList').change(function () {
                $(this).parent('form').submit();
            });

        });
    </script>
@stop