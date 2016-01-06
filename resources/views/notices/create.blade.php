@extends('app')

@section('content')

    <h1 class="page-heading">Prepare a DMCA notice </h1>

    {!! Form::open(['method' => 'GET', 'action' => 'NoticesController@confirm']) !!}

        <!--To whom we are sending the notice -->
        <div class="form-group">
            {!! Form::label('provider_id','Who are we sending this to?') !!}
            {!! Form::select('provider_id',$providers,null,['class'=>'form-control']) !!}
        </div>

        <!--infringing_titlet -->
        <div class="form-group">
            {!! Form::label('infringing_title','Title of the content that is being infringed upon:') !!}
            {!! Form::text('infringing_title',null,['class'=>'form-control']) !!}
        </div>

        <!--infringing_link -->
        <div class="form-group">
            {!! Form::label('infringing_link','Link to where the content is located:') !!}
            {!! Form::text('infringing_link',null,['class'=>'form-control']) !!}
        </div>

        <!--original_link-->
        <div class="form-group">
            {!! Form::label('original_link','Link to the original content that verifies infringing:') !!}
            {!! Form::text('original_link',null,['class'=>'form-control']) !!}
        </div>

        <!--original_description -->
        <div class="form-group">
            {!! Form::label('original_description','Some extra information:') !!}
            {!! Form::textarea('original_description',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Preview notice',null,['class'=>'form-control']) !!}
        </div>
    {!! Form::close() !!}

@include('errors/list')
@endsection