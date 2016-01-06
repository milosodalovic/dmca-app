@extends('app')

@section('content')

    <h1 class="page-heading">Confirm</h1>

    {!! Form::open(['action' => 'NoticesController@store']) !!}

    <!--template -->
    <div class="form-group">
        {!! Form::textarea('template',$template,['class'=>'form-control']) !!}
    </div>

    <!--Deliver DMCA button -->
    <div class="form-group">
        {!! Form::submit('Deliver DMCA',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection