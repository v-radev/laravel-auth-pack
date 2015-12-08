<?php
    $delete = isset($delete) ? $delete : 'Delete';
?>
{!! Form::open(['method' => 'DELETE', 'route' => $route, 'class' => 'form-inline']) !!}
    {!! Form::submit($delete, ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Do you really want to delete this item?");']) !!}
{!! Form::close() !!}