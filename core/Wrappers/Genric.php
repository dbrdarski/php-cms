<?php
namespace Core\Wrappers;

class Generic{

    public function _()
    {
        return $this;
    }

    public function isNothing()
    {
        return false;
    }

    public function isSomething()
    {
        return false;
    }

    public function isError()
    {
        return false;
    }

    public function _log()
    {
        return $this;
    }

    public function __call($method, $args)
    {
        return $this;
    }

    public static function __callStatic($method, $args)
    {
        return $this;
    }

    public function __get($prop)
    {
        return $this;
    }

}