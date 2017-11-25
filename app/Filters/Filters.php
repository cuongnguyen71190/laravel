<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request, $builder;

	protected $filters = [];

	/**
	 * [__construct description]
	 * @param Request $request [description]
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * [apply description]
	 * @return [type]          [description]
	 */
	public function apply($builder)
	{
		$this->builder = $builder;

		foreach ($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter)) {
				$this->$filter($value);
			}
		}

        return $this->builder;
	}

	public function getFilters()
	{
		return $this->request->only($this->filters);
	}
}
