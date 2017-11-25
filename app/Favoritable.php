<?php
namespace App;

/**
 * summary
 */
trait Favoritable
{
	/**
	 * [favorites description]
	 * @return [type] [description]
	 */
    public function favorites()
    {
    	return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * [favorite description]
     * @return [type] [description]
     */
    public function favorite()
    {
    	$attributes = ['user_id' => auth()->id()];
    	if (! $this->favorites()->where($attributes)->exists()) {
    		return $this->favorites()->create($attributes);
    	}
    }

    /**
     * [isFavorited description]
     * @return boolean [description]
     */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * [getFavoritesCountAttribute description]
     * @return [type] [description]
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
