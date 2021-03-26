<?php


namespace Task1;


class Queen extends AbstractChessmen
{
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function move($x, $y)
    {
        $xshift = abs($x - $this->x);
        $yshift = abs($y - $this->y);
        $difference = abs($xshift - $yshift);
        if(!($difference == 0 xor $difference == $xshift xor $difference == $yshift) or $x > 8 or $y > 8 or $x < 1 or $y < 1) {
            throw new \Exception('Такой ход королевой недопустим!');
        }
        $this->x = $x;
        $this->y = $y;
    }
}