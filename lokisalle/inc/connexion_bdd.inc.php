<?php

$mysqli = new mysqli("cl1-sql21", "dgx20964", "lokisalle", "dgx20964");
if($mysqli->connect_error)
{
	die("Oups ! Un probleme est survenu lors de la tentative de connexion a la BDD: ".$mysqli->connect_error);
}