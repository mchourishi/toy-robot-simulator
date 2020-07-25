<?php

use PHPUnit\Framework\TestCase;


class CommandTest extends TestCase
{
    private const MOVE = 'move';
    private const LEFT = 'left';
    private const RIGHT = 'right';
    private const REPORT = 'report';

    public function setUp(): void
    {
        parent::setUp();
        $this->user_input = new \ToyRobo\UserInput();
    }

    public function test_robo_position_1(){
        $this->user_input->handleInput('place 2,2,NORTH');
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::LEFT);
        $this->user_input->handleInput(self::REPORT);
        $this->expectOutputString("Robot new co-ordinates : 2,3,WEST\n");
    }

    public function test_robo_position_2(){
        $this->user_input->handleInput('place 2,2,NORTH');
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::RIGHT);
        $this->user_input->handleInput(self::REPORT);
        $this->expectOutputString("Robot new co-ordinates : 2,3,EAST\n");
    }

    public function test_robo_position_3(){
        $this->user_input->handleInput('place 1,2,EAST');
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::LEFT);
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::REPORT);
        $this->expectOutputString("Robot new co-ordinates : 3,3,NORTH\n");
    }

    public function test_moves_are_not_out_of_range(){
        $this->user_input->handleInput('place 4,4,EAST');
        $this->user_input->handleInput(self::MOVE);
        $this->user_input->handleInput(self::MOVE); //out of range move
        $this->user_input->handleInput(self::REPORT);
        $this->expectOutputString("Robot new co-ordinates : 5,4,EAST\n");
    }
}
