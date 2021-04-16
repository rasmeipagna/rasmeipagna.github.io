<?php

$mysqli = @new Mysqli("cl1-sql23", "usj87943", "GBfiZlbF0u2M", "usj87943");
if($mysqli->connect_error)
{
	die("Oups ! Un probleme est survenu lors de la tentative de connexion a la BDD: ".$mysqli->connect_error);
}