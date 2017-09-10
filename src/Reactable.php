<?php

namespace Muratbsts\Reactable;

/**
 * Class Reactable
 * @package Muratbsts\Reactable
 */
class Reactable
{
    /**
     * Render reaction links for a reactable
     * @param $reactable Reactable instance
     * @return mixed
     */
    public static function render($reactable)
    {
        return view('reactable::reactions', [
            'resource' => $reactable,
        ]);
    }
}