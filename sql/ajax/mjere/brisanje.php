<?php

if (!$_POST["id"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Mjera.php';

$mjere = new Mjera($_GET["osoba_id"]);
echo $mjere->delete();
