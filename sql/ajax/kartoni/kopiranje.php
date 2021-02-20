<?php

if (!$_POST["kartonId"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Karton.php';

$karton = new Karton();
$karton->setId($_POST["kartonId"]);
$karton->kopiraj();
$noviKartonId = $karton->id;


echo "Karton kopiran/" . $noviKartonId;
