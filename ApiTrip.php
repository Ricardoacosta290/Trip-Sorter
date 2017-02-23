<?php

class Boarding
{
	private $departure = '', $arrival = '', $seat = '';
	
	function __construct($departure, $arrival, $seat)
	{
		$this->departure = $departure;
		$this->arrival = $arrival;
		$this->seat = $seat;
	}

	public static function getSeat($obj)
	{
		return $obj->seat;
	}

	public static function getDeparture($obj)
	{
		return $obj->departure;
	}

	public static function getArrival($obj)
	{
		return $obj->arrival;
	}
}

class AirportBusPass extends Boarding
{
	function __construct($departure, $arrival, $seat = null)
	{
		parent::__construct($departure, $arrival, $seat);
	}

	public function toString()
	{
		return 
			'Take the Airport bus from ' . Boarding::getDeparture($this) . 
			' to ' . Boarding::getArrival($this) . 
			'. ' . (Boarding::getSeat($this) ? 'Sit in seat ' . Boarding::getSeat($this) . '.' : ' No Seat.');
	}
}

class FlightPass extends Boarding
{
	private $flight, $gate, $counter;

	function __construct($departure, $arrival, $seat, $flight, $gate, $counter = null)
	{
		parent::__construct($departure, $arrival, $seat);
		$this->flight = $flight;
		$this->gate = $gate;
		$this->counter = $counter;
	}

	public function toString()
	{
		return 
			'From ' . Boarding::getDeparture($this) . 
			', Take flight ' . $this->flight . 
			' to ' . Boarding::getArrival($this) . 
			'. Gate ' . $this->gate . 
			', seat ' . Boarding::getSeat($this) . 
			'. ' . ($this->counter ? 'Baggage drop at ticket counter ' . $this->counter . '.' : 'Baggage will be automatically transferred from your last leg.');
	}
}

class TrainPass extends Boarding
{
	private $train;
	
	function __construct($departure, $arrival, $seat, $train)
	{
		parent::__construct($departure, $arrival, $seat);
		$this->train = $train;
	}

	public function toString()
	{
		return 
			'Take Train ' . $this->train . 
			' from ' . Boarding::getDeparture($this) . 
			' to ' . Boarding::getArrival($this) . 
			'. Sit in seat ' . Boarding::getSeat($this) . '.';
	}
}

class SortTrip
{
	private $arrivalIndex = array();
	private $departureIndex = array();

	function SortTrip($Boarding)
	{
		$this->Boarding = $Boarding;
	}

	public function sort()
	{
		self::Index();

		$startLocation = self::getStart();

		$sortedBoarding = array();
		$currentLocation = $startLocation;

		while ($currentBoarding = (array_key_exists($currentLocation, $this->departureIndex)) ? $this->departureIndex[$currentLocation] : null) 
		{
			array_push($sortedBoarding, $currentBoarding);
			$currentLocation = Boarding::getArrival($currentBoarding);
		}

		return $sortedBoarding;
	}

	function Index()
	{
		$tmp = count($this->Boarding);

		for ($i = 0; $i < $tmp; $i++) 
		{
			$Boarding = $this->Boarding[$i];

			$this->departureIndex[Boarding::getDeparture($Boarding)] = $Boarding;
			$this->arrivalIndex[Boarding::getArrival($Boarding)] = $Boarding;
		}
	}

	private function getStart()
	{
		$tmp = count($this->Boarding);

		for ($i = 0; $i < $tmp; $i++) 
		{
			$departure = Boarding::getDeparture($this->Boarding[$i]);

			if (!array_key_exists($departure, $this->arrivalIndex)) 
			{
				return $departure;
			}
		}
		return null;
	}
}

class Trip
{
	public function __construct($Boarding)
	{
		$this->Boarding = $Boarding;
		$Boarding = new SortTrip($this->Boarding);
		$this->Boarding = $Boarding->sort(); 
	}

	public function PrintTrip()
	{
		$ToPrint = '';
		$tmp = count($this->Boarding);

		for ($i = 0; $i < $tmp; $i++) 
		{
			$currentPass = $this->Boarding[$i];
			$ToPrint .= '<li>' . $currentPass->toString() . '</li>';
			$ToPrint .= '</br>';
		}

		$ToPrint .= '<li>You Arrived. :) </li>';

		return $ToPrint;
	}
}

?>