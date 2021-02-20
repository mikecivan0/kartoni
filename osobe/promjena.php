<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

if(!isset($_GET["id"])){
	header('location: index.php');
}else{

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';

$pacijent = new Pacijent();
$pacijent->setId($_GET["id"]);
$pacijent->findById();


if($_POST){
	
	$pacijent->setIme($_POST["ime"]);
	$pacijent->setPrezime($_POST["prezime"]);
	$pacijent->setZanimanje($_POST["zanimanje"]);
	$pacijent->setSpol($_POST["spol"]);
	$pacijent->setGodiste($_POST["godiste"]);
	$pacijent->setTelefon($_POST["telefon"]);
	$pacijent->setMBO($_POST["mbo"]);
	$pacijent->setDopunsko($_POST["dopunsko"]);
	
	$greske = $pacijent->provjeraPrijePromjene();
	
	if(empty($greske)){
		
		$pacijent->update();
		header('location: pacijenti.php?id=' . $pacijent->id);
		
	}
}

$title = 'Izmjena podataka';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	<?php if($pacijent->ime!=""){ 		
			$_POST["spol"] = $pacijent->spol;
	?>
			<div class="large-12 columns">
				<form action='<?= $_SERVER["PHP_SELF"] . "?id=" . $pacijent->id ?>' method='POST'>
					<?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId', null, null, $pacijent->id, null, false) ?>
					<fieldset class="polja">
						<legend class="hide-for-small-only">
							Podaci osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
						</legend>
						<legend style="font-size:4vw;" class="show-for-small-only">
							Podaci osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
						</legend>	
						<div class="row mt40">
							<div class="large-3 columns">
								<?= Html::InputSaGreskom($greske, 'ime', 'Ime', $pacijent -> ime, 'text', array('placeholder'=>'Ime','autocomplete'=>'off')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', $pacijent -> prezime, 'text', array('placeholder'=>'Prezime','autocomplete'=>'off')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::InputSaGreskom($greske, 'godiste', 'Dob(godište)', $pacijent -> godiste, 'text', 
														 array('pattern'=>'^(19|20)\d{2}$','placeholder'=>'1956','autocomplete'=>'off')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::Select('Spol', 'spol', 'spol', null, array( 
																					array('id' => 'musko', 'text' => 'muško', 'value' => '1'), 
																					array('id' => 'zensko', 'text' => 'žensko', 'value' => '0')
																				)
												 ) ?>
							</div>
						</div>
						<div class="row mb40">
							<div class="large-3 columns">
								<?= Html::Input('Zanimanje', 'text', 'zanimanje', 'zanimanje', null, null, $pacijent -> zanimanje, array('placeholder'=>'Zanimanje')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::InputSaGreskom($greske, 'mbo', 'MBO / broj EU iskaznice', $pacijent -> mbo, 'text', array('placeholder'=>'1234567')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::Input('Broj dopunskog osiguranja', 'text', 'dopunsko', 'dopunsko', null, null, $pacijent -> dopunsko, array('placeholder'=>'12345678')) ?>
							</div>
							<div class="large-3 columns">
								<?= Html::Input('Telefon', 'text', 'telefon', 'telefon', null, null, $pacijent -> telefon, array('placeholder'=>'091/123-4567')) ?>
							</div>
						</div>
						<div class='row'>
							<div class='large-6 columns'>
								<?= Html::Submit('Spremi izmjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
							</div>
							<div class='large-6 columns'>
								<a href="pacijenti.php?id=<?= $id ?>">
									<?= Html::Button('Odustani', array('siroko', 'alert', 'round', 'button', 'spremi')) ?>
								</a>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
	<?php } ?>
</div>

<?php
include_once '../masters/masterBottom.php';
}
?>

