<?php

namespace App\Models\Traits;

use App\Models\Revision;
use Illuminate\Support\Facades\Auth;

trait Revisions
{

    /**
     * Holds the revision between the 'restoring' and 'restored' events
     *
     * @var Revision
     */
    protected $revisionRestored = null;

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
                'user_id'           => Auth::id() ?? null,
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
                'user_id'           => Auth::id() ?? null,
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
            'user_id'           => Auth::id() ?? null,
            'key'               => 'deleted_at',
            'old_value'         => null,
            'new_value'         => $this->attributes['deleted_at'],
        ]);
    }

    /**
     * Handles the model's 'restoring' event
     *
     * @return void
     */
    protected function revisionsAfterRestoring()
    {
        $this->revisionRestored = new Revision([
            'revisionable_type' => static::class,
            'revisionable_id'   => $this->attributes[$this->primaryKey],
            'user_id'           => Auth::id() ?? null,
            'key'               => 'deleted_at',
            'old_value'         => $this->attributes['deleted_at'],
            'new_value'         => null,
        ]);
    }

    /**
     * Handles the model's 'restored' event
     *
     * @return void
     */
    protected function revisionsAfterRestored()
    {
        $this->revisionRestored->save();

        $this->revisionRestored = null;
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

        if (method_exists(static::class, 'restoring') && method_exists(static::class, 'restored')) {
            static::restoring(function ($model) {
                $model->revisionsAfterRestoring();
            });

            static::restored(function ($model) {
                $model->revisionsAfterRestored();
            });
        }
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
