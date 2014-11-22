@extends('guardian::layout.master')

@section('content')
    <h3 class="heading">Edit Role</h3>
    @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>
    @endif
    {{Form::open(['route'=>['role.update',$role->id,'ref'=>Request::get('ref')],'class'=>'form form-horizontal','style'=>'margin-top:50px'])}}
    <div class="form-group">
        {{ Form::label('role_name','Role Name:',['class'=>'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            <span class="label label-danger">{{$errors->first('role_name')}}</span>
            {{ Form::text('role_name',Input::old('role_name',$role->role_name),['class'=>'form-control','placeholder'=>'only alpha chars allowed...']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description','Role Description:',['class'=>'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            <span class="label label-danger">{{$errors->first('description')}}</span>
            {{ Form::text('description',Input::old('description',$role->description),['class'=>'form-control','placeholder'=>'only alpha chars allowed...']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('capabilities','Attach Capabilities:',['class'=>'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            @if($capabilities->isEmpty())
                {{Form::text('fake',null,['class'=>'form-control','placeholder'=>'Create Some Capabilities First!','disabled'])}}
            @else
            {{ Form::select('capabilities',$capabilities->lists('capability','id'),Input::old('capabilities',$role->capabilities->lists('id')),['name'=>'capabilities[]','multiple']) }}
            @endif
        </div>
    </div>
    <div class="text-center">
        {{HTML::link(URL::route('role.list',Input::get('ref')), 'Back',['class'=>'btn btn-warning'])}}
        {{Form::submit('Update Role',['class'=>'btn btn-default'])}}
    </div>
    {{Form::close()}}
@stop