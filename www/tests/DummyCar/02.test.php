<?php

require_once "../../core/TestCase.php";
require_once "helpers/TestDummyCar.php";

$test = new TestCase("TEST02 - Dummy Car Damage and Repairing");

$test->run(function($t) {

	$t->log("Creating new Car... ");
	$car = new TestDummyCar('Test02');
	$t->ok();

	$t->log("Adding Fuel... ");
	$car->addFuel();
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isFull());

	$t->log("Run 5000 km... ");
	$car->run(5000);
	$t->log("[Fuel=" . $car->getFuel() . "l, TotalDist=" . $car->getKilometers() . "km] ");
	$t->assert($car->isEmpty());

	$t->log("Has Damage?... ");
	$damage = $car->getDamage();
	$t->log("[Damage=" . $damage . "] ");
	$t->assert($damage != 0);

	$t->log("Repairing... ");
	$car->repair();
	$damage = $car->getDamage();
	$t->log("[Damage=" . $damage . "] ");
	$t->assert($damage == 0);

});
