<?php

if (!$_GET["term"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Pacijent.php';

$pacijent = new Pacijent();
echo $pacijent->findByTerm($_GET["term"]);
