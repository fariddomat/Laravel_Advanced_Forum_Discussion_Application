<?php

namespace App\Http\Controllers;

use Session;
use App\Discussion;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Notification;

class DisucssionsController extends Controller
{
    public function create()
    {
        return view('discuss');
    }

    public function store(Request $request)
    { 
        $this->validate($request,[
            'channel_id'=>'required',
            'title'=>'required',
            'content'=>'required',
        ]);
        $disussion=Discussion::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'channel_id'=>$request->channel_id,
            'user_id'=>Auth::id(),
            'slug'=>str_slug($request->title),
        ]);
        
        Session::flash('success','Discussion succssfully created');
        return redirect()->route('discussion',['slug'=>$disussion->slug]);
    }

    public function show($slug)
    {
        $discussion=Discussion::where('slug',$slug)->first();
        $best_answer=$discussion->replies()->where('best_answer',1)->first();   
        return view('discussions.show',compact('discussion','best_answer'));
    }

    public function reply($id)
    {
        $discussion=Discussion::find($id);
        $reply=Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply,
        ]);
        $reply->user->points +=25;
        $reply->user->save();

        $watchers=array();
        foreach ($discussion->watchers as $watcher) {
            array_push($watchers,User::find($watcher->user_id));
        }
        Notification::send($watchers,new \App\Notifications\NewReplyAdded($discussion));
        
        Session::flash('success','Replied to discussion');
        return redirect()->back();
    }

    public function edit($slug) 
    {
        $discussion=Discussion::where('slug',$slug)->first();
        return view('discussions.edit',compact('discussion'));
    }

    public function update(Request $request,$id)
    { 
        $this->validate($request,[
            'content'=>'required',
        ]);
        $discussion=Discussion::find($id);
        $discussion->content=$request->content;
        $discussion->save();
        
        Session::flash('success','Discussion Updated Succssfully');
        return redirect()->route('discussion',['slug'=>$discussion->slug]);
    }

}
