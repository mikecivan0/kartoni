<?php

if (!$_POST["osobaId"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Karton.php';

$karton = new Karton();
echo $karton->novi($_POST["osobaId"]);
