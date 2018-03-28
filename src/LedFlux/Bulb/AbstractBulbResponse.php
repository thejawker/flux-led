<?php

namespace TheJawker\ControlStuff\LedFlux\Bulb;

use TheJawker\ControlStuff\LedFlux\Color;

abstract class AbstractBulbResponse
{
    public $color;
    public $type;
    public $presetPattern;
    public $on;

    public function setColor(
        int $red = null,
        int $green = null,
        int $blue = null,
        int $white = null,
        int $white2 = null
    )
    {
        $this->color =
            new Color(
                $red,
                $green,
                $blue,
                $white,
                $white2
            );
    }
}