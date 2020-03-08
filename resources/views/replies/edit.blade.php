@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading text-center">Update a reply</div>

    <div class="panel-body">
        <form action="{{route('reply.update',$reply->id)}}" method="POST">
            {{csrf_field()}}
            
            <div class="form-group">
                <label for="content">Answer a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                    {{$reply->content}}
                </textarea>
                <div class="form-group">
                    <button class="btn btn-success pull-right">
                        Edit Reply
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection