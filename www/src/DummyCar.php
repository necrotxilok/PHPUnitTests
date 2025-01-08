<?php


/**
 * Dummy Car Class
 */
class DummyCar
{
	public string $serial;

	protected int $fuel = 0; // ml
	protected int $damage = 0;
	protected int $kilometers = 0;
	
	protected int $consume = 25; // ml/km

	protected int $maxFuel = 50000; // ml
	protected int $maxDamage = 100;
	protected int $fiability = 99;
	
	public function getFuel() 
	{
		return floor($this->fuel / 1000);
	}

	public function getDamage() 
	{
		return $this->damage;
	}

	public function getKilometers() 
	{
		return $this->kilometers;
	}

	public function __construct(string $serial)
	{
		$this->serial = $serial;
	}

	public function addFuel() 
	{
		$this->fuel = $this->maxFuel;
	}

	public function isFull() {
		return $this->fuel == $this->maxFuel;
	}

	public function isEmpty() {
		return $this->fuel == 0;
	}

	public function run($distance) 
	{
		for ($i=0; $i < $distance; $i++) { 
			if (!$this->canRun()) {
				return;
			}
			$this->fuel -= $this->consume;
			$this->kilometers++;
			if ($this->kilometers % 100 == 0) {
				$this->fail();
			}
		}
	}

	public function canRun() 
	{
		$broken = $this->isBroken();
		$fuel = $this->fuel - $this->consume >= 0;
		return !$broken && $fuel;
	}

	protected function fail() {
		if ($this->isBroken()) {
			return;
		}
		$rand = rand(1, 100);
		if ($rand > $this->fiability) {
			$this->damage++;
		}
	}	

	public function repair() 
	{
		$this->damage = 0;
	}

	public function isBroken() 
	{
		return $this->damage >= $this->maxDamage;
	}

}
