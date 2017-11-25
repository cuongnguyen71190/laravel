<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
	protected $filters = ['by', 'popular'];
	
	/**
	 * [by description]
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();
        
        return $this->builder->where('user_id', $user->id);
	}

	/**
	 * [popular description]
	 * @return [type] [description]
	 */
	protected function popular()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('replies_count', 'desc');
	}
}
