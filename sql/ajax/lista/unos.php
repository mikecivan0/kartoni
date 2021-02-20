<?php

if (!$_POST["osoba_id"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Lista.php';

$lista = new Lista();
$lista->setOsobaId($_POST["osoba_id"]);
$lista->setTip($_POST["tipTerapije"]);
$lista->setVrijeme($_POST["vrijeme"]);
$lista->setNastavno($_POST["nastavno"]);
$lista->setNapomena($_POST["napomena"]);

echo $lista->insert();
