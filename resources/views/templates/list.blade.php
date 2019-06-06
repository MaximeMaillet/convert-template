@extends('adminlte::page')

@section('title', 'Templates')

@section('content_header')
    <h1>Templates</h1>
@stop

@section('content')
    <ul>
        @foreach($templates as $templateName)
            <li><a href="{{ route('template.edit', ['name' => $templateName]) }}">{{ $templateName }}</a></li>
        @endforeach
    </ul>
@stop
