# Toy Robot Simulator
PHP based Toy Robot Simulator on a square table top.

## Description
- The application is a simulation of a toy robot moving on a square tabletop,
  of dimensions 5 units x 5 units.
- The application will accept following commands as command line arguments :-
    * PLACE X,Y,F (X & Y is table position and F is direction that robot is facing)
    * MOVE
    * LEFT
    * RIGHT
    * REPORT  
    * EXIT
- PLACE will put the toy robot on the table in position X,Y and facing NORTH,
  SOUTH, EAST or WEST.
- MOVE will move the toy robot one unit forward in the direction it is
  currently facing.
- LEFT and RIGHT will rotate the robot 90 degrees in the specified direction
  without changing the position of the robot.
- REPORT will announce the X,Y and F of the robot.
- EXIT will terminate simulator from CLI.

## Installation
- Run ``composer install`` to install dependencies. This will install phpunit.

### Run Simulator
- The Robot Simulator can be given commands via CLI running app.php Eg: toy-robo/app.php
- It will display "Enter Command" on CLI.
- Start from PLACE command eg: PLACE 2,2,NORTH
- Follow any sequence of commands including MOVE, LEFT, RIGHT, PLACE.
- To get the final resulting position of robot type REPORT.
- Type EXIT to exit from the terminal.

### Run Tests
- Run  ```vendor/bin/phpunit tests/``` from toy-robo directory. 
