<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/6/4
 * Time: 下午11:43
 */

namespace Framework;


class Route
{
    protected $request = [];

    public function get($uri, $callback)
    {
        if (!$callback instanceof \Closure) {
            throw new \Exception("{$callback} is not a callable function.");
        }

        $this->request['get'][$uri][$callback];
    }
}