<?php

namespace App\Traits;

trait Observable
{
	public static function bootObservable()
	{
		$sobserver = '\\App\\Observers\\'. class_basename(static::class) . 'Observer';

		if (!class_exists($sobserver)) {
			return;
		}

		(new static)->registerObserver($sobserver);
	}
}