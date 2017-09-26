<?php

namespace Muratbsts\Reactable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reaction extends Model
{
    protected $table = 'reactions';

    public $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reactable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reactor(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include reactions by a given Reactor.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model   $reactor
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReactedBy(Builder $query, Model $reactor): Builder
    {
        return $query->where('reactor_type', $reactor->getMorphClass())
            ->where('reactor_id', $reactor->getKey());
    }

    /**
     * Scope a query to only include reactions for a given Reactable.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model   $reactable
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReactionsTo(Builder $query, Model $reactable): Builder
    {
        return $query->where('reactable_type', $reactable->getMorphClass())
            ->where('reactable_id', $reactable->getKey());
    }
}