@extends('app')

@section('content')
   <h1 class="page-heading">Your Notices</h1>

    <table class="table table-stiped table-bordered">
        <thead>
            <th>This content:</th>
            <th>Accessible here:</th>
            <th>Is infringing upon my work here:</th>
            <th>Notice sent:</th>
            <th>Content removed:</th>
        </thead>
        <tbody>

        @foreach($notices as $notice)
            <tr>
                <td> {{$notice->infringing_title}}</td>
                <td> {!! link_to($notice->infringing_link) !!}</td>
                <td> {!! link_to($notice->original_link) !!}</td>
                <td> {{$notice->created_at->diffForHumans()}}</td>
                <td>
                    {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::checkbox('content_removed',$notice->content_removed, $notice->content_removed) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

        </tbody>


    </table>

@endsection