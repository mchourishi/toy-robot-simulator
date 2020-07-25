<?php

namespace ToyRobo;

/**
 * Class to validate user input.
 */
class UserInput
{
    const CMD_PLACE = 'PLACE';
    const CMD_MOVE = 'MOVE';
    const CMD_LEFT = 'LEFT';
    const CMD_RIGHT = 'RIGHT';
    const CMD_REPORT = 'REPORT';
    const CMD_EXIT = 'EXIT';

    const DIR_SOUTH = 'SOUTH';
    const DIR_NORTH = 'NORTH';
    const DIR_EAST = 'EAST';
    const DIR_WEST = 'WEST';

    private $command = '';
    private $xcoord = 0;
    private $ycoord = 0;
    private $direction = '';
    private $run = true;
    private $valid = true;

    /**
     * UserInput constructor.
     */
    public function __construct()
    {
        $this->table = new Table(5, 5);
        $this->valid = true;
        $this->runCommand = new Command();
    }

    /**
     * Prompts user to enter a command
     */
    public function promptInput()
    {
        while ($this->run) {
            $this->valid = true;
            $input = readline('Enter a command : ');
            $this->handleInput($input);
        }
    }

    /**
     * Handles, validates user input
     * @param $input
     */
    public function handleInput($input)
    {
        $input = strtoupper(trim($input));
        $input = preg_replace('/\s+/', ' ', $input); // Remove any extra spaces.
        $input = preg_replace('/\s*,\s*/', ',', $input); // Remove any spaces after comma
        $args = explode(' ', $input);
        $this->command = $args[0];
        if ($this->isValidCommand($this->command)) {
            $placeArguments = [];
            if ($this->command === self::CMD_PLACE) {
                $placeArguments = $this->handlePlaceCommand(isset($args[1]) ? $args[1] : '');
            }
            if ($this->valid) {
                $this->processInput($this->command, $placeArguments);
            }
        } else {
            echo "Please enter a valid command.\n";
        }
    }

    /**
     * Handles Place command to contain valid co-ordinates and direction.
     * @param $args
     * @return array $arguments
     */
    public function handlePlaceCommand($args)
    {
        $arguments = (isset($args)) ? explode(",", $args) : [];
        if (count($arguments) == 3) {
            $this->xcoord = $arguments[0];
            $this->ycoord = $arguments[1];
            $this->direction = $arguments[2];
            if (!$this->table->isValidPosition($this->xcoord, $this->ycoord)) {
                $this->valid = false;
                echo sprintf("%d,%d is not within table range\n", $this->xcoord, $this->ycoord);
            }
            if (!$this->isValidDirection($this->direction)) {
                $this->valid = false;
                echo sprintf("%s is not a valid direction\n", $this->direction);
            }

        } else {
            $this->valid = false;
            echo "PLACE command needs to have 3 arguments passed\n";
        }
        return $arguments;
    }

    /**
     * Processes Input
     * @param $command
     * @param $placeArguments
     */
    public function processInput($command, $placeArguments = [])
    {
        switch ($command) {
            case self::CMD_EXIT:
                $this->run = false;
                break;
            case self::CMD_PLACE:
                // Process Place Command.
                $this->runCommand->place($placeArguments[0], $placeArguments[1], $placeArguments[2]);
                break;
            case self::CMD_MOVE:
                $this->runCommand->move();
                break;
            case self::CMD_RIGHT:
                $this->runCommand->rotate(self::CMD_RIGHT);
                break;
            case self::CMD_LEFT:
                $this->runCommand->rotate(self::CMD_LEFT);
                break;
            case self::CMD_REPORT:
                $this->runCommand->report();
                break;
            default:
                break;
        }
    }

    /** Checks if the passed command is a valid command
     * @param string $command
     * @return bool
     */
    public function isValidCommand($command)
    {
        $validCommands = [self::CMD_PLACE, self::CMD_MOVE, self::CMD_RIGHT, self::CMD_LEFT, self::CMD_REPORT, self::CMD_EXIT];
        return (in_array(strtoupper($command), $validCommands));
    }

    /** Checks if the passed direction is a valid direction.
     * @param $direction
     * @return bool
     */
    public function isValidDirection($direction)
    {
        $validDirection = [self::DIR_NORTH, self::DIR_SOUTH, self::DIR_EAST, self::DIR_WEST];
        return (in_array(strtoupper($direction), $validDirection));
    }
}



