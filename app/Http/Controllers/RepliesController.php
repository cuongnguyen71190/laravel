<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;

class RepliesController extends Controller
{
    /**
     * [__construct description]
     */
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * [store description]
     * @param  [type] $channelId [description]
     * @param  Thread $thread    [description]
     * @return [type]            [description]
     */
    public function store($channelId, Thread $thread)
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);

    	$thread->addReply([
    		'body' => request('body'),
    		'user_id' => auth()->id()
    	]);

    	return back()->with('flash', 'Your reply has been left');
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(request(['body']));
    }

    /**
     * [destroy description]
     * @param  Reply  $reply [description]
     * @return [type]        [description]
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted!']);
        }

        return back()->with('flash', 'The reply has been deleted!');
    }
}
