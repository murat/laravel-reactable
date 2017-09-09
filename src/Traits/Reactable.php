<?php

namespace Muratbsts\Reactable\Traits;

use Muratbsts\Reactable\Models\Reaction;

trait Reactable
{
    /**
     * Get Reactable's reactions
     * @return mixed
     */
    public function reactions()
    {
        return $this->morphMany('Muratbsts\\Reactable\\Models\\Reaction', 'reactable');
    }

    /**
     * Create new reaction
     * @param      $context
     * @param null $reactor
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function reaction($context, $reactor = null)
    {
        $create = array();

        $create['reactable_id'] = $this->id;
        $create['reactable_type'] = get_class($this);
        $create['context'] = $context;

        /**
         * Save Reactor info if given
         */
        if ($reactor) {
            $create['reactor_id'] = $reactor->id;
            $create['reactor_type'] = get_class($reactor);
        }

        return Reaction::firstOrCreate($create);
    }

    /**
     * Get Reactable's reaction summary
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
}