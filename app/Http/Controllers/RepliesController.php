<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
class RepliesController extends Controller
{
    public function like($id)
    {
        $like=Like::create([
            'reply_id'=>$id,
            'user_id'=>Auth::id(),
        ]);

        Session::flash('success','You liked the reply.');
        return redirect()->back();
    }
    public function unlike($id)
    {
        $like=Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();

        Session::flash('success','You unliked the reply.');
        return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply=Reply::find($id);
        $reply->best_answer=1;
        $reply->save();

        $reply->user->points+=100;
        $reply->user->save();

        Session::flash('success','Reply has marked as the best answer.');
        return redirect()->back();
    }

    
    public function edit($id) 
    {
        $reply=Reply::find($id);
        return view('replies.edit',compact('reply'));
    }

    public function update(Request $request,$id)
    { 
        $this->validate($request,[
            'content'=>'required',
        ]);
        $reply=Reply::find($id);
        $reply->content=$request->content;
        $reply->save();
        
        Session::flash('success','Reply Updated Succssfully');
        $slug=$reply->discussion->slug;
        return redirect()->route('discussion',compact('slug'));
    }
}
