<?php

namespace Muratbsts\Reactable\Traits;

use Exception;
use Muratbsts\Reactable\Models\Reaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reactable
{
    /**
     * Get Reactable's reactions
     */
    public function reactions(): MorphMany
    {
        return $this->morphMany('Muratbsts\\Reactable\\Models\\Reaction', 'reactable');
    }

    /**
     * Create new reaction
     *
     * @param  $context
     * @param  null    $reactor
     * @return mixed
     */
    public function reaction($context, $reactor = null)
    {
        $reaction = new Reaction();

        $reaction->reactable_id = $this->id;
        $reaction->reactable_type = get_class($this);
        $reaction->context = $context;

        /**
         * Save Reactor info if given
         */
        if ($reactor) {
            $reaction->reactor_id = $reactor->id;
            $reaction->reactor_type = get_class($reactor);
        }

        try {
            $reaction->save();
            return true;
        } catch (\Exception $e) {
            return $this->error("Could not save reaction because {$e->getMessage()}");
        }
    }

    /**
     * Get Reactable's reaction summary
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