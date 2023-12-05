<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasComments
{
	/**
	 * Boot the trait.
	 * 
	 * @return void
	 */
	public static function bootHasSlug(): void
	{
		static::creating(function ($model) {
			$model->setSlug();
		});
	}

    /**
     * Set the slug attribute.
     *
     * @return void
     */
    public function setSlug()
    {
        $slugField = $this->getSlugField();

        // Check if the attribute exists on the model before retrieving its value
        if ($this->getAttribute($slugField)) {
            $this->attributes['slug'] = Str::slug($this->getAttribute($slugField));
        }
    }

	/**
	 * Get the field used for generating the slug.
	 * 
	 * @return string
	 */
	public function getSlugField(): string
	{
		return isset($this->slugField) ? $this->slugField : 'title';
	}
}