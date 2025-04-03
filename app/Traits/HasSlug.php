<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
	private static $__fromColumn = 'name';

	public static function bootHasSlug()
	{
		self::setSlugFromColumn();

		static::creating(function ($model) {
			$model->slug = $model->{self::$__fromColumn};
		});
	}

	public function setSlugAttribute($value)
	{
		$slug = Str::slug($value, '-');

		if ($i = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count()) {
			$slug = "{$slug}-{$i}";
		}

		$this->attributes['slug'] = $slug;
	}

	private static function setSlugFromColumn()
	{
		self::$__fromColumn = isset(self::$slugFromColumn) ? self::$slugFromColumn : self::$__fromColumn;
	}
}