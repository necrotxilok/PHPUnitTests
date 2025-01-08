<?php

require_once "../../core/TestCase.php";
require_once "../../src/DummyCar.php";

$test = new TestCase("TEST01 - Dummy Car Fuel and Run");

$test->run(function($t) {

	$t->log("Creating new Car... ");
	$car = new DummyCar('Test01');
	$t->ok();

	$t->log("Adding Fuel... ");
	$car->addFuel();
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isFull());

	$t->log("Run 100 km... ");
	$car->run(100);
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert(!$car->isEmpty());

	$t->log("Run 5000 km... ");
	$car->run(5000);
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isEmpty());

	$t->log("Adding Fuel... ");
	$car->addFuel();
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isFull());

	$t->log("Run 5000 km... ");
	$car->run(5000);
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isEmpty());

});
