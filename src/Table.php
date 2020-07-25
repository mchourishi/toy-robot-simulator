<?php

namespace ToyRobo;

/**
 * Table Class
 */
class Table
{

    private $width = 0;
    private $height = 0;

    /**
     * Table constructor.
     * @param int $height
     * @param int $width
     */
    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Check if x & y are valid and fall on the table.
     * @param $x
     * @param $y
     * @return bool
     */
    public function isValidPosition($x, $y)
    {
        return ($x >= 0 && $x <= $this->width) && ($y >= 0 && $y <= $this->height);
    }

}


