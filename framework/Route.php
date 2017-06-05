<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/6/4
 * Time: 下午11:43
 */

namespace Rurushu;


class Route
{
    protected $request = [];

    public function get($uri, $callback)
    {
        if (!$callback instanceof \Closure) {
            throw new \Exception("{$callback} is not a callable function.");
        }

        $this->request[$uri]['get'] = $callback;
    }

    public function parse(Request $request)
    {
        if (!isset($this->request[$request->getUri()])) {
            throw new \Exception("Not found.");
        } elseif (!isset($this->request[$request->getUri()][$request->getMethod()])) {
            throw new \Exception("Method not allowed.");
        } else {
            $callback = $this->request[$request->getUri()][$request->getMethod()];
            if (!($callback instanceof \Closure)) {
                throw new \Exception("{$callback} is not a callable method.");
            }
            $callback($request);
        }
    }
}