@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <a href="{{ route('template.list') }}">Show templates</a>
    <br>
    <a href="{{ route('convert.make') }}">Converts</a>
@stop
