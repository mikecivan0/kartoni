<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../klase/SQL.php';
include_once '../klase/Karton.php';
include_once '../klase/Pacijent.php';

$pacijent = new Pacijent();
$karton = new Karton();

if($_POST){	
	
	$pacijent->setIme($_POST["ime"]);
	$pacijent->setPrezime($_POST["prezime"]);
	$pacijent->setZanimanje($_POST["zanimanje"]);
	$pacijent->setSpol($_POST["spol"]);
	$pacijent->setGodiste($_POST["godiste"]);
	$pacijent->setTelefon($_POST["telefon"]);
	$pacijent->setMBO($_POST["mbo"]);
	$pacijent->setDopunsko($_POST["dopunsko"]);
	
	$greske = $pacijent->provjeraPrijeUnosaNovog();		
	
	if(empty($greske)){
		
		$pacijent->noviPacijent();	
		$karton->setOsobaId($pacijent->id);		
		$karton->noviKarton();
		
		header('location: promjena.php?id=' . $karton->id . '&tab=ostaliPodaci');
	}
}
$footerScript .= '<script src="' . $putanjaApp . 'js/kartoni/index.js"></script>';
$title = 'Fizioterapeutski karton';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

?>
<div class="row mt40 polja">
	
	<div class="large-12 columns center">
		<h3 class="plavaSlova"><i>Pretražite fizioterapeutske kartone</i></h3>
	</div>
	<hr>
	
	<div class="large-12 columns">
		<?= Html::Input('<b>Pretraga kartona</b> (pretraga po imenu i/ili prezimenu ili broju upisa)', 'text', 'pacijent', 'pacijent', 
						null, null, null, array('autofocus'=>true)) ?>
	</div>	
	<hr />
	<div class="large-12 columns center mt40">
		<h3 class="plavaSlova"><i>Unesite novog pacijenta i kreirajte novi fizioterapeutski karton</i></h3>
	</div>
	<div class="large-12 columns">
		<form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" class="mt40">
			<fieldset>
				<legend>
					Podaci novog pacijenta
				</legend>
				<div class="row">
					<div class="large-12 columns" id="osnovniPodaci">
						<?php
							include_once 'osnovniPodaci.php';
						?>
					</div>
				</div>
				<div class="row mt40">
					<div class="large-12 columns">
						<?= Html::Submit('Kreiraj karton', array('siroko', 'secondary', 'spremi', 'round', 'button')) ?>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
?>

