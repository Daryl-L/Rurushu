<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/6/5
 * Time: 下午10:24
 */

namespace Rurushu;


use function Couchbase\defaultDecoder;

class Request
{
    protected $uri;

    protected $method;

    protected $header;

    protected $get;

    protected $post;

    protected $files;

    protected $additional;

    public function __construct()
    {
        $this->uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->header = getallheaders();
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
    }

    public function __get($name)
    {
        return $this->post[$name] ?? $this->get[$name] ?? $this->header[$name];
    }

    public function __set($name, $value)
    {
        switch (true) {
            case isset($this->post[$name]):
                $this->post[$name] = $value;
                break;
            case isset($this->get[$name]):
                $this->get[$name] = $value;
                break;
            case isset($this->header[$name]):
                $this->header[$name] = $value;
                break;
            default:
                $this->additional[$name] = $value;
                break;
        }
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }
}