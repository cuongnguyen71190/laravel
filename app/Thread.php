<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }
    
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
		// return '/threads/' . $this->channel->slug . '/' . $this->id;
    }

    /**
     * [replies description]
     * @return [type] [description]
     */
    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    /**
     * [creator description]
     * @return [type] [description]
     */
    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * [channel description]
     * @return [type] [description]
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * [addReply description]
     * @param [type] $reply [description]
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * [scopeFilter description]
     * @param  [type] $query   [description]
     * @param  [type] $filters [description]
     * @return [type]          [description]
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
