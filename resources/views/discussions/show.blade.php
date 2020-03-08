@extends('layouts.app')

@section('content')


<div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{$discussion->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
        <span>{{$discussion->user->name}},<b>( {{$discussion->user->points}} )</b>
            <b>{{$discussion->created_at->diffForHumans()}}</b></span>


        @if ($discussion->hasBestAnswer())
        <span class="btn btn-success pull-right btn-xs">Closed</span>
        @else
        <span class="btn btn-danger pull-right btn-xs">Open</span>

        @endif

        @if (Auth::id()==$discussion->user->id && !$discussion->hasBestAnswer())
        <a style="margin-right: 8px;" href="{{route('discussion.edit',$discussion->slug)}}" class="btn btn-info pull-right btn-xs">Edit</a>
        @endif
        @if ($discussion->is_being_watched_by_auth_user())
        <a style="margin-right: 8px;" href="{{route('discussion.unwatch',$discussion->id)}}" class="btn btn-default pull-right btn-xs">unwatch</a>
        @else
        <a style="margin-right: 8px;" href="{{route('discussion.watch',$discussion->id)}}" class="btn btn-default pull-right btn-xs">watch</a>

        @endif
    </div>
    <div class="panel-body">
        <h4 class="text-center"><b>{{$discussion->title}}</b></h4>
        <hr>
        <p class="text-center">{!!$discussion->content!!}</p>
        <hr>
        @if ($best_answer)
        <div class="text-center" style="padding:40px">
            <h3 class="text-center">BEST ANSWER</h3>
            <div class="panel panel-success">
                <div class="panel-heading">

                    <img src="{{$best_answer->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
                    <span>{{$best_answer->user->name}}<b>( {{$best_answer->user->points}} )</b></span>
                </div>
                <div class="panel-body">
                    {{$best_answer->content}}
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="panel-footer">
        <span>
            {{$discussion->replies->count()}} Replies
        </span>
        <a href="{{route('channel',$discussion->channel->slug)}}"
            class="btn btn-default pull-right btn-xs">{{$discussion->channel->title}}</a>

    </div>
</div>


@foreach ($discussion->replies as $r)

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{$r->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
        <span>{{$r->user->name}},<b>( {{$r->user->points}} )</b> <b>{{$r->created_at->diffForHumans()}}</b></span>

        @if (!$best_answer)
        @if (Auth::id()==$discussion->user->id)
        <a style="margin-right: 8px;" href="{{route('discussion.best.answer',$r->id)}}" class="btn btn-xs btn-primary pull-right">Mark as best
            answer</a>
        @endif

        @if (Auth::id()==$r->user->id)
        <a style="margin-right: 8px;" href="{{route('reply.edit',$r->id)}}" class="btn btn-xs btn-info pull-right">Edit</a>

        @endif
        @endif
    </div>
    <div class="panel-body">

        <p class="text-center">{{$r->content}}</p>

    </div>
    <div class="panel-footer">
        @if ($r->is_liked_by_auth_user())
        <a href="{{route('reply.unlike',$r->id)}}" class="btn btn-danger btn-xs">Unlike <span
                class="badge">{{$r->likes->count()}}</span></a>
        @else
        <a href="{{route('reply.like',$r->id)}}" class="btn btn-success btn-xs">Like <span
                class="badge">{{$r->likes->count()}}</span></a>
        @endif
    </div>
</div>
@endforeach

<div class="panel panel-default">
    <div class="panel-body">
        @if (Auth::check())
        <form action="{{route('discussion.reply',$discussion->id)}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="reply">Leave a reply . . .</label>
                <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn pull-right">Leave a reply</button>
            </div>
        </form>
        @else
        <div class="text-center">
            <h2>Sign in to leave a reply</h2>
        </div>
        @endif
    </div>
</div>
@endsection