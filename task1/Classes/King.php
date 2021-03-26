<?php


namespace Task1;


class King extends AbstractChessmen
{
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function move($x, $y)
    {
        if(abs($x - $this->x) > 1 or abs($y - $this->y) >1 or $x > 8 or $x < 1 or $y > 8 or $y < 1) {
            throw new \Exception('Такой ход королём недопустим!');
        }
        $this->x = $x;
        $this->y = $y;
    }
}