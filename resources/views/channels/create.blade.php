@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Create a new channels</div>

    <div class="panel-body">
        <form action="{{route('channels.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" class="form-control" name="channel" placeholder="Channel Name">
            </div>
            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" type="submit">Save channel</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection