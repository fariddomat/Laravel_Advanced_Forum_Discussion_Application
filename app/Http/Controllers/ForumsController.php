<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    public function index()
    {
        switch (request('filter')) {
            case 'me':
                $discussions = Discussion::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(3);
                break;
            case 'solved':
                $discussions = array();
                foreach (Discussion::all() as $d) {
                    if ($d->hasBestAnswer()) {
                        array_push($discussions,$d);
                    }
                }
                $discussions=new Paginator($discussions,3);
            break;
            case 'unsolved':
                $discussions = array();
                foreach (Discussion::all() as $d) {
                    if (!$d->hasBestAnswer()) {
                        array_push($discussions,$d);
                    }
                }
                $discussions=new Paginator($discussions,3);
            break;

            default:
                $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);

                break;
        }
        return view('forum', compact('discussions'));
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();
        $discussions = $channel->discussions()->paginate(5);
        return view('channel', compact('discussions'));
    }
}
