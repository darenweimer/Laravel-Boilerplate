<?php

namespace App\Models\Traits;

use App\Models\Revision;
use Illuminate\Support\Facades\Auth;

trait Revisions
{

    /**
     * Handles the model's 'created' event
     *
     * @return void
     */
    protected function revisionsAfterCreated()
    {
        $exclusions = array_merge(
            $this->hidden ?? [],
            $this->dontRevision ?? [],
            ['id', 'updated_at']
        );

        $attributes = array_diff_key(
            $this->attributes, array_flip($exclusions)
        );

        foreach ($attributes as $attribute => $value) {
            Revision::create([
                'revisionable_type' => static::class,
                'revisionable_id'   => $this->attributes[$this->primaryKey],
                'user_id'           => Auth::id(),
                'key'               => $attribute,
                'old_value'         => null,
                'new_value'         => $value,
            ]);
        }
    }

    /**
     * Handles the model's 'updated' event
     *
     * @return void
     */
    protected function revisionsAfterUpdated()
    {
        $exclusions = array_merge(
            $this->hidden ?? [],
            $this->dontRevision ?? [],
            ['updated_at']
        );

        $attributes = array_diff_key(
            $this->changes, array_flip($exclusions)
        );

        foreach ($attributes as $attribute => $value) {
            Revision::create([
                'revisionable_type' => static::class,
                'revisionable_id'   => $this->attributes[$this->primaryKey],
                'user_id'           => Auth::id(),
                'key'               => $attribute,
                'old_value'         => $this->original[$attribute] ?? null,
                'new_value'         => $value,
            ]);
        }
    }

    /**
     * Handles the model's 'deleted' event
     *
     * @return void
     */
    protected function revisionsAfterDeleted()
    {
        Revision::create([
            'revisionable_type' => static::class,
            'revisionable_id'   => $this->attributes[$this->primaryKey],
            'user_id'           => Auth::id(),
            'key'               => 'deleted_at',
            'old_value'         => null,
            'new_value'         => $this->attributes['deleted_at'] ?? now(),
        ]);
    }

    /**
     * Bootstraps the model's event handlers
     *
     * @return void
     */
    public static function bootRevisions()
    {
        static::created(function ($model) {
            $model->revisionsAfterCreated();
        });

        static::updated(function ($model) {
            $model->revisionsAfterUpdated();
        });

        static::deleted(function ($model) {
            $model->revisionsAfterDeleted();
        });
    }

    /**
     * Relationship 1:Many
     *
     * Returns the revisions associated with the model
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

}
