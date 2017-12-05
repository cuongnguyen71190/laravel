<?php
namespace App;

/**
 * summary
 */
trait Favoritable
{
    protected static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }


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

    public function unFavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        $this->favorites()->where($attributes)->get()->each->delete();
    }

    /**
     * [isFavorited description]
     * @return boolean [description]
     */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
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
