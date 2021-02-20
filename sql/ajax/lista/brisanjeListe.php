<?php

if (!$_POST["id"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Lista.php';

$lista = new Lista();
echo $lista->brisanjeListe();
