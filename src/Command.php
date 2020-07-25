<?php

namespace ToyRobo;

class Command
{
    private $x;
    private $y;
    private $direction;

    const DIR_SOUTH = 'SOUTH';
    const DIR_NORTH = 'NORTH';
    const DIR_EAST = 'EAST';
    const DIR_WEST = 'WEST';

    const CMD_LEFT = 'LEFT';
    const CMD_RIGHT = 'RIGHT';

    /**
     * Command constructor.
     * @param string $x
     * @param string $y
     * @param string $direction
     */
    public function __construct($x = '', $y = '', $direction = '')
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->table = new Table(5, 5);
    }

    /** Execute Place Command, Set Coordinates and Direction to the parameters passed.
     * @param $xc
     * @param $yc
     * @param $placeDirection
     */
    public function place($xc, $yc, $placeDirection)
    {
        $this->x = $xc;
        $this->y = $yc;
        $this->direction = $placeDirection;
    }

    /**
     * Execute Move Command, Increment x or y depending on direction.
     * Set new co-ordinates if is valid and not out if table range.
     */
    public function move()
    {
        if (!$this->robotPlaced()) {
            return;
        }

        $xval = $this->x;
        $yval = $this->y;

        if ($this->direction == self::DIR_NORTH || $this->direction == self::DIR_SOUTH) {
            $yval += 1;
        } else {
            $xval += 1;
        }
        // Check if new co-ordinates falls into the table dimensions.
        if (!$this->table->isValidPosition($xval, $xval)) {
            return;
        }
        $this->x = $xval;
        $this->y = $yval;
    }

    /**
     * Execute left and right command, determine resulting direction.
     * @param $type
     */
    public function rotate($type)
    {
        if (!$this->robotPlaced()) {
            return;
        }
        $arrDirections = [self::DIR_NORTH, self::DIR_EAST, self::DIR_SOUTH, self::DIR_WEST];
        $index = array_search($this->direction, $arrDirections);
        $resultIndex = ($type === self::CMD_RIGHT) ? ($index + 1) % 4 : (4 + $index - 1) % 4;
        $this->direction = $arrDirections[$resultIndex];
    }

    /**
     * Print the resulting co-ordinates and direction.
     */
    public function report()
    {
        if (!$this->robotPlaced()) {
            return;
        }
        echo sprintf("Robot new co-ordinates : %d,%d,%s\n", $this->x, $this->y, $this->direction);
    }

    /**
     * Determine if the Robot is placed.
     * @return bool
     */
    public function robotPlaced()
    {
        return (!empty($this->x) && !empty($this->y));
    }

}
