@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">Update a  disucssion</div>

    <div class="panel-body">
        <form action="{{route('discussion.update',$discussion->id)}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
            <input value="{{$discussion->title}}" type="text" class="form-control disabled" name="title" disabled>
            </div>
            
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control ckeditor">
                    {!!$discussion->content!!}
                    
                </textarea>
                <div class="form-group">
                    <button class="btn btn-success pull-right">
                        Edit discussion
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection