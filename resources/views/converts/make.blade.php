@extends('adminlte::page')

@section('title', 'Converts')

@section('content_header')
    <h1>Converts</h1>
@stop

@section('content')
    @if ($resultTemplate)
    <div class="box box-solid box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Results</h3>
        </div>
        <div class="box-body">
            {{ $resultTemplate }}
        </div>
    </div>
    @endif

    {!! form($form) !!}
@stop
