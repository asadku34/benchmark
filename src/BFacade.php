<?php

namespace Asad\Bench;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Asad\Bench\Skeleton\SkeletonClass
 */
class BFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'benchmark';
    }
}
