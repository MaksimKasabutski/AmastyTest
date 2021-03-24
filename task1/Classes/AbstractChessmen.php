<?php

namespace Task1;

abstract class AbstractChessmen implements IChessmen
{
    protected $x;

    protected $y;

    public function getPosition(): string
    {
        return "(x = $this->x, y = $this->y)";
    }
}