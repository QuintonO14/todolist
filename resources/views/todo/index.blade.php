@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 class="text-center">To Do List</h1>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['method'=>'GET', 'action'=> 'ThingsController@create']) !!}
                        {!! Form::label('head', 'Title:') !!}
                        {!! Form::text('headline', null, ['class'=>'form-control headline']) !!}
                        {!! Form::label('body', 'Task Content') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control task', 'size'=>'50x2']) !!}
                        {!! Form::button(' Create Task',['class'=>'btn btn-primary fa fa-pencil ', 'style'=>'margin-top: 10px', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="notes">
        @foreach($things as $thing)
            <div class="sticky">
                <h2>{{$thing->headline}}</h2>
                <hr>
                <p>{{$thing->body}}</p>
                <small class="time">{{$thing->created_at ? $thing->created_at->diffForHumans() : $thing->updated_at->diffForHumans()}}</small>
                <div class="controlButtons">
                    <button class="btn btn-success margin-right fa fa-pencil-square-o" data-toggle="modal" data-target="#editModal"> Edit</button>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['todo.destroy', $thing->id]]) !!}
                    {!! Form::button(' Delete', ['class'=>'btn btn-danger fa fa-trash','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center"> Edit Task </h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="modal-body">
                            {!! Form::model($thing, ['method'=>'PUT', 'route'=>['todo.update', $thing->id]]) !!}
                            {!! Form::label('headline', 'Title:') !!}
                            {!! Form::text('headline', null, ['class'=>'form-control']) !!}
                            {!! Form::label('body', 'Task Content:') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control task', 'size'=>'50x2']) !!}
                            <div class="modal-footer">
                            {!! Form::submit('Update Task', ['class'=>'btn btn-primary']) !!}
                            {!! Form::button('Close', ['class'=>'btn btn-danger', 'data-dismiss'=>'modal']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

@endsection