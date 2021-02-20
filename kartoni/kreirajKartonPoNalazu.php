<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../klase/SQL.php';
include_once '../klase/Karton.php';
include_once '../klase/Terapija.php';

$title = 'Kreiranje kartona prema nalazu';
$bodyClass = 'vjezbe';

include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

if(isset($_GET["osoba_id"])&&isset($_GET["nalaz_id"])&&isset($_GET["prvaTh"])&&isset($_GET["zadnjaTh"])){
	
	$karton = new Karton();
	$karton->setOsobaId($_GET["osoba_id"]);
	$karton->setNalazId($_GET["nalaz_id"]);
	$karton->kreirajPremaNalazu($putanjaApp);
	$idNovogKartona = $karton->id;	
		
	$terapija = new Terapija();
	$terapija->setKartonId($idNovogKartona);
	$terapija->setPrvaTh($_GET["prvaTh"]);
	$terapija->setZadnjaTh($_GET["zadnjaTh"]);
	$odgovor = $terapija->insertSetTh();
	
	if($odgovor=='Unešeno'){
		header('location: ' . $putanjaApp . 'kartoni/promjena.php?id=' . $idNovogKartona);
	}else{
		echo $odgovor;
	}
	
}else{
	echo "Nevaljani podaci.";
}

include_once '../masters/masterBottom.php';
?>

