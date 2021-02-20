<?php

if (!$_POST["kartonId"]) {
	exit ;
}

include_once '../../../config/conf.php';
include_once '../../../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

if(strtotime($_POST["datumZadnjeTerapije"])>=strtotime($_POST["datumPrveTerapije"])){
	
	include_once '../../../klase/SQL.php';
	include_once '../../../klase/Terapija.php';
	
	$terapija = new Terapija();	
	$terapija->setKartonId($_POST["kartonId"]);
	$terapija->setPrvaTh($_POST["datumPrveTerapije"]);
	$terapija->setZadnjaTh($_POST["datumZadnjeTerapije"]);
	echo $terapija->insertSetTh();
}else{
	echo "Datum prve terapije mora biti raniji nego datum zadnje terapije.";
}

