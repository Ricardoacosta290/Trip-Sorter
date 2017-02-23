<?php

//INCLUIR API 
require_once('ApiTrip.php');

  //CREAMOS EL VIAJE DESORDENADO
  $Trip = new Trip([
    new FlightPass('Portugal', 'Argentina', '4B', 'SK24', '62'),
    new FlightPass('Argentina', 'Chile', '45B', '78A', '65'),
    new FlightPass('Colombia', 'Venezuela', '9B', 'SK32', '32'),
    new FlightPass('Chile', 'Colombia', '65B', '98A', '86'),
    new AirportBusPass('Barcelona', 'Gerona Airport'),    
    new FlightPass('Stockholm', 'New York JFK', '8B', 'SK27', '20'),
    new TrainPass('Madrid', 'Barcelona', '65B', '88A'),
    new FlightPass('Gerona Airport', 'Stockholm', '8A', 'SK755', '45B', '344'),
    new AirportBusPass('Germany', 'Italy'),    
    new FlightPass('New York JFK', 'Paris', '12A', 'ST12', '02'),
    new TrainPass('Paris', 'Germany', '25C', '43B'),
    new FlightPass('Italy', 'Portugal', '2C', 'SE312', '32B', '235') ]);

//IMPRIMIMOS EL VIAJE ORDENADO
print ($Trip->PrintTrip());

//$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
//print "Process Time: {$time}";