<?php

namespace Muratbsts\Reactable\Traits;

use Exception;
use Muratbsts\Reactable\Models\Reaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reactor
{
    /**
     * Get Reactor's reactions
     *
     * @return MorphMany
     */
    public function reactions(): MorphMany
    {
        return $this->morphMany('Muratbsts\\Reactable\\Models\\Reaction', 'reactor');
    }

    /**
     * Create new reaction with Reactor to Reactable
     *
     * @param  $context
     * @param  $reactable
     * @return mixed
     */
    public function react($context, $reactable)
    {
        $reaction = new Reaction();

        $reaction->context = $context;
        $reaction->reactor_id = $this->id;
        $reaction->reactor_type = get_class($this);
        $reaction->reactable_id = $reactable->id;
        $reaction->reactable_type = get_class($reactable);

        try {
            $reaction->save();
            return true;
        } catch (\Exception $e) {
            return $this->error("Could not save reaction because {$e->getMessage()}");
        }
    }

    /**
     * Get Reactor's reaction summary
     *
     * @return mixed
     */
    public function getReactionSummary()
    {
        return $this->reactions()
            ->getQuery()
            ->select('context', \DB::raw('count(*) as count'))
            ->groupBy('context')
            ->get();
    }

    /**
     * Catch error
     *
     * @param  $error string
     * @return Exception
     */
    protected function error($error): Exception
    {
        throw new \Exception($error);
    }
}