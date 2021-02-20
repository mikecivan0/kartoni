<?php

if (!$_POST["hfOsobaId"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';
include_once '../../../alati/Alati.php';

Auth::isAuth($ida, $putanjaApp);
include_once '../../../klase/SQL.php';
include_once '../../../klase/Mjera.php';

$mjere = new Mjera();
$mjere->setOsobaId($_POST["hfOsobaId"]);
$mjere->setBolesnaStrana($_POST["bolesnaStrana"]);
$mjere->setDatum($_POST["datum"]);

if($mjere->provjeraPrijeUnosa()){
	echo $mjere->insert();
}else{
	$noviDatum = Alati::datum($_POST["datum"]);
	echo "Mjere sa datumom <b>" . $noviDatum . "</b> su već unešene. Ne možete više puta unijeti mjere sa istim datumom. Ukoliko želite dodati/izmijeniti neke mjere za određeni datum molimo idite na izmjenu mjera sa tim datumom.";
}

