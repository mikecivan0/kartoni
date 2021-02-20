<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

if(!isset($_GET["id"])){
	header('location: index.php');
}

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Lista.php';
include_once '../klase/Pacijent.php';

$listaUpdate = new Lista();

if($_POST){	
	
	$listaUpdate->setId($_POST["hfStavkaId"]);
	$listaUpdate->setVrijeme($_POST["vrijeme"]);
	$listaUpdate->setTip($_POST["tipTerapije"]);
	$listaUpdate->setNastavno($_POST["nastavno"]);
	$listaUpdate->setNapomena($_POST["napomena"]);
	$listaUpdate->update();
	
	header('location: index.php');
	
}


if(isset($_GET["id"])){	

	$stavka = new Lista();
	$stavka->setId($_GET["id"]);
	$stavka->findById();
	
	$select006 = ($stavka->tip==006 ) ? "selected" : null;
	$select007 = ($stavka->tip==007 ) ? "selected" : null;

	$nastavakTrue = ($stavka->nastavno==true) ? "selected" : null;
	$nastavakFalse = ($stavka->nastavno==false) ? "selected" : null;
	
	$pacijent = new Pacijent();
	$pacijent->setId($stavka->osoba_id);
	$pacijent->findById();
	
}else{
	header('location: index.php');
}


$title = 'Izmjena podataka';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	<div class="large-12 columns">
		<form action='<?= $_SERVER["PHP_SELF"] . "?id=" . $stavka->id ?>' method='POST'>
			<?= Html::Input(null, 'hidden', 'hfStavkaId', 'hfStavkaId', null, null, $stavka->id, null, false) ?>
			<fieldset class="polja">
				<legend>
					<?= $pacijent->prezime . " " . $pacijent->ime ?>
				</legend>
			<div class='large-2 medium-6 small-6 columns'>
				<?= Html::Input('Vrijeme dolaska', 'time', 'vrijeme', 'vrijeme', null, null, $stavka->vrijeme) ?>
			</div>
			<div class='large-2 medium-6 small-6 columns'>
				<label>Tip terapije</label>
				<select name='tipTerapije' id='tipTerapije'>
					<option value='006' <?= $select006 ?> >006</option>
					<option value='007' <?= $select007 ?> >007</option>
				</select>
			</div>
			<div class='large-2 medium-6 small-6 columns'>
				<label>Nastavno</label>
				<select name='nastavno' id='nastavno'>
					<option value='1' <?= $nastavakTrue ?> >Da</option>
					<option value='0' <?= $nastavakFalse ?> >Ne</option>
				</select>
			</div>
			<div class='large-6 medium-6 small-6 columns'>
				<?= Html::Input('Napomena', 'text', 'napomena', 'napomena', null, null, $stavka->napomena) ?>
			</div>
			<div class='large-6 columns'>
				<?= Html::Submit('Spremi izmjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
			</div>
			<div class='large-6 columns'>
				<a href="index.php">
					<?= Html::Button('Odustani', array('siroko', 'alert', 'round', 'button', 'spremi')) ?>
				</a>
			</div>	
			</fieldset>
		</form>
	</div>
</div>

<?php
include_once '../masters/masterBottom.php';
?>

