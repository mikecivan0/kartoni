<?php

if (!$_POST["kartonId"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Terapija.php';

$terapija = new Terapija();
echo json_encode($terapija->findByCard($_POST["kartonId"]));