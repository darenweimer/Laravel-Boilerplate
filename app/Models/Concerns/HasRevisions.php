<?php

namespace App\Models\Concerns;

use App\Models\Revision;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

trait HasRevisions
{

    /**
     * The primary key value for the model being deleted
     *
     * @var mixed
     */
    protected $revisionsDeleting = null;

    /**
     * Handles the model's 'created' event
     *
     * @return void
     */
    protected function hasRevisionsAfterCreated() : void
    {
        if ($id = $this->attributes[$this->primaryKey] ?? null) {
            $exclusions = array_merge(
                $this->hidden ?? [],
                $this->dontRevision ?? [],
                [$this->primaryKey, 'updated_at']
            );

            $attributes = array_diff_key(
                $this->attributes, array_flip($exclusions)
            );

            foreach ($attributes as $attribute => $value) {
                $this->revisions()
                    ->create([
                        'user_id'   => Auth::id(),
                        'key'       => $attribute,
                        'old_value' => null,
                        'new_value' => $value,
                    ]);
            }
        }
    }

    /**
     * Handles the model's 'updated' event
     *
     * @return void
     */
    protected function hasRevisionsAfterUpdated() : void
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
            $this->revisions()
                ->create([
                    'user_id'   => Auth::id(),
                    'key'       => $attribute,
                    'old_value' => $this->original[$attribute] ?? null,
                    'new_value' => $value,
                ]);
        }
    }

    /**
     * Handles the model's 'deleting' event
     *
     * @return void
     */
    protected function hasRevisionsAfterDeleting() : void
    {
        $this->revisionsDeleting = $this->attributes[$this->primaryKey] ?? null;

        if (isset($this->revisionsDeleting)) {
            return;
        }

        if (!($this instanceOf \Illuminate\Database\Eloquent\Relations\Pivot)) {
            return;
        }

        $matches = static::select($this->primaryKey)
            ->where($this->attributes)
            ->get();

        if ($matches->count() === 1) {
            $this->revisionsDeleting = $matches->first()->{$this->primaryKey};
        }
    }

    /**
     * Handles the model's 'deleted' event
     *
     * @return void
     */
    protected function hasRevisionsAfterDeleted() : void
    {
        if (isset($this->revisionsDeleting)) {
            $this->revisions()
                ->create([
                    'user_id'   => Auth::id(),
                    'key'       => 'deleted_at',
                    'old_value' => null,
                    'new_value' => $this->attributes['deleted_at'] ?? now(),
                ]);

            $this->revisionsDeleting = null;
        }
    }

    /**
     * Bootstraps the model's event handlers
     *
     * @return void
     */
    public static function bootHasRevisions() : void
    {
        static::created(function ($model) {
            $model->hasRevisionsAfterCreated();
        });

        static::updated(function ($model) {
            $model->hasRevisionsAfterUpdated();
        });

        static::deleting(function ($model) {
            $model->hasRevisionsAfterDeleting();
        });

        static::deleted(function ($model) {
            $model->hasRevisionsAfterDeleted();
        });
    }

    /**
     * Relationship 1:Many
     *
     * Returns the revisions associated with the model
     *
     * @return mixed
     */
    public function revisions() : mixed
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

}
