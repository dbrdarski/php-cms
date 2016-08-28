<?php

namespace Core\Wrappers;

class Nothing extends Generic{

    public function isNothing()
    {
        return true;
    }
    public function of()
    {
        return new Nothing();
    }
}