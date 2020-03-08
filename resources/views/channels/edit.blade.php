@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit channels</div>

    <div class="panel-body">
        <form action="{{route('channels.update',['channel'=>$channel->id])}}" method="POST">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <input type="text" class="form-control" value="{{$channel->title}}" name="channel"
                    placeholder="Channel Name">
            </div>
            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" type="submit">Update channel</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection