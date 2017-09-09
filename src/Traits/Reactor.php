<?php

namespace Muratbsts\Reactable\Traits;

use Muratbsts\Reactable\Models\Reaction;

trait Reactor
{

    /**
     * Get Reactor's reactions
     * @return mixed
     */
    public function reactions()
    {
        return $this->morphMany('Muratbsts\\Reactable\\Models\\Reaction', 'reactor');
    }


    /**
     * Create new reaction with Reactor to Reactable
     * @param $context
     * @param $reactable
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function react($context, $reactable)
    {
        $reaction = Reaction::firstOrCreate([
            'context' => $context,
            'reactor_id' => $this->id,
            'reactor_type' => get_class($this),
            'reactable_id' => $reactable->id,
            'reactable_type' => get_class($reactable),
        ]);

        return $reaction;
    }

    /**
     * Get Reactor's reaction summary
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