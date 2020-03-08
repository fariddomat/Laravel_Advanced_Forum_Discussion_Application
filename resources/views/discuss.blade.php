@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">Create a new disucssion</div>

    <div class="panel-body">
        <form action="{{route('discussions.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
            <input value="{{old('title')}}" type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="channel">Pike a channel</label>
                <select name="channel_id" id="channel_id" class="form-control">
                    @foreach ($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control ckeditor">
                    {{old('content')}}
                </textarea>
                <div class="form-group">
                    <button class="btn btn-success pull-right">
                        Create discussion
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection