<?php

use PHPUnit\Framework\TestCase;


class UserInputTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user_input = new \ToyRobo\UserInput();
    }

    public function test_when_invalid_command_is_sent(){
        $this->user_input->handleInput('invalidcommand');
        $this->expectOutputString("Please enter a valid command.\n");
    }

    public function test_invalid_place_command(){
        $this->user_input->handleInput('place');
        $this->expectOutputString("PLACE command needs to have 3 arguments passed\n");
    }

    public function test_invalid_place_command_params(){
        $this->user_input->handleInput('place 2');
        $this->expectOutputString("PLACE command needs to have 3 arguments passed\n");
    }

    public function test_invalid_place_command_direction(){
        $this->user_input->handleInput('place 2,3,NOTOK');
        $this->expectOutputString("NOTOK is not a valid direction\n");
    }

    public function test_out_of_range_place_args(){
        $this->user_input->handleInput('place 6,6,NORTH');
        $this->expectOutputString("6,6 is not within table range\n");
    }
}
