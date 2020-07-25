<?php

use PHPUnit\Framework\TestCase;
use ToyRobo\Table;

class TableTest extends TestCase
{
    public function test_table_coordinates_is_valid_position(){
        $table = new Table(5,5);
        $this->assertTrue($table->isValidPosition(2,2));
        $this->assertTrue($table->isValidPosition(0,0));
        $this->assertTrue($table->isValidPosition(2,3));

        $this->assertFalse($table->isValidPosition(5,6));
        $this->assertFalse($table->isValidPosition(6,7));
        $this->assertFalse($table->isValidPosition(6,4));
    }

}
