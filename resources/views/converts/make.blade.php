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
            <div class="box-tools pull-right">
                <a id="change-html" class="label label-default">HTML</a>
                <a id="change-raw" class="label label-default" style="display: none">RAW</a>
            </div>
        </div>
        <div class="box-body" id="result-raw">
            {!! $resultTemplate !!}
        </div>
        <div class="box-body" id="result-html" style="display: none;">
            {{ $resultTemplate }}
        </div>
    </div>
    @endif

    {!! form($form) !!}
@stop

@section('js')
    <script>
	    $("#change-html").click(function() {
            $("#result-raw").css('display', 'none');
            $("#change-html").css('display', 'none');
            $("#change-raw").css('display', 'block');
            $("#result-html").css('display', 'block');
	    });
	    $("#change-raw").click(function() {
            $("#result-raw").css('display', 'block');
            $("#change-html").css('display', 'block');
            $("#change-raw").css('display', 'none');
            $("#result-html").css('display', 'none');
	    });
    </script>
@stop
