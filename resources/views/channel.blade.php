@extends('layouts.app')

@section('content')

@foreach ($discussions as $d)
<div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
        <span>{{$d->user->name}}, <b>{{$d->created_at->diffForHumans()}}</b></span>
      
        <a style="margin-right: 8px;" href="{{route('discussion',$d->slug)}}" class="btn btn-default pull-right btn-xs">view</a>
   
        @if ($d->hasBestAnswer())
            <span style="margin-right: 8px;" class="btn btn-success pull-right btn-xs">Closed</span>
        @else
        <span style="margin-right: 8px;" class="btn btn-danger pull-right btn-xs">Open</span>
        
            @endif
        </div>
    <div class="panel-body">
        <h4 class="text-center"><b>{{$d->title}}</b></h4>
        <p class="text-center">{!!str_limit($d->content,50)!!}</p>

    </div>
    <div class="panel-footer">
        <p>
            {{$d->replies->count()}} Replies
        </p>
    </div>
</div>
@endforeach
<div class="text-center">{{$discussions->links()}}</div>

@endsection