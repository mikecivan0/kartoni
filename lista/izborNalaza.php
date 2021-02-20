<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';
include_once '../klase/Nalaz.php';
include_once '../klase/Uputnica.php';
include_once '../klase/Terapija.php';


$pacijent = new Pacijent();
$nalaz = new Nalaz();
$uputnica = new Uputnica();
$terapija = new Terapija();
	
if(isset($_GET["id"])){	

	$pacijent->setId($_GET["id"]);
	$pacijent->findById();
	$pacijent->jeLiNastavno();	
	
	$nalaz->setOsobaId($pacijent->id);	
	$nalazi = $nalaz->findByOId();
	
	$uputnica->setOsobaId($pacijent->id);
	$uputnice = $uputnica->findByOId();
	
	$terapija->setOsobaId($pacijent->id);
	$pocetakZadnjegSetaTerapija = $terapija->pocetakZadnjegSetaTerapija();
	
}

$vrijeme = (isset($_COOKIE["vrijeme"])) ? $_COOKIE["vrijeme"] : null;
$tipTerapije = (isset($_COOKIE["tipTerapije"])) ? $_COOKIE["tipTerapije"] : null;

$select006 = ($tipTerapije==006 ) ? "selected" : null;
$select007 = ($tipTerapije==007 ) ? "selected" : null;

$nastavakTrue = ($pacijent->nastavno==true) ? "selected" : null;
$nastavakFalse = ($pacijent->nastavno==false) ? "selected" : null;
 
$title = 'Izbor nalaza za dodati osobu na listu za zvati';
$bodyClass = 'vjezbe';
$footerScript .= '<script src="' . $putanjaApp . 'js/cookie.js"></script>
				  <script src="' . $putanjaApp . 'js/lista/unos.js"></script>';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
		<?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId', null, null, $pacijent->id, null, false) ?>		
		<?= Html::Input(null, 'hidden', 'putanjaApp', 'putanjaApp', null, null, $putanjaApp, null, false) ?>		
	<hr />
	
	<?php if($pacijent!=null){ ?>	
	<div class="large-12 columns">		
		<fieldset class="polja">
			<legend class="hide-for-small-only">
				Podaci osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
			</legend>
			<legend style="font-size:4vw;" class="show-for-small-only">
				Podaci osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
			</legend>		
		<?php	
			$spol = ($pacijent->spol==1) ? "muško" : "žensko";
			echo "<p>Ime: <b>" . $pacijent->ime . "</b></p>";
			echo "<p>Prezime: <b> " . $pacijent->prezime . "</b></p>";
			echo "<p>Godište: <b> " . $pacijent->godiste . "</b></p>";
			echo "<p>Spol: <b> " . $spol . "</b></p>";
			echo "<p>MBO: <b> " . $pacijent->mbo . "</b></p>";
			echo "<p>Datumi D1 uputnica: <b>" . $uputnice . "</b></p><br />";
			
		?>
		<h6 class='mt40 mb40 red'>
			<i>
				1. Obavezno upišite <b>vrijeme</b> dolaska na terapiju, odaberite <b>tip terapije</b> i je li u pitanju <b>nastavak terapije</b><br />
				2. Kliknite gumb <b>Dodaj</b> da bi ste unijeli osobu na listu za zvati
			</i>
		</h6>
		<div class='row mb20'>
			<div class='large-2 medium-6 small-6 columns'>
				<?= Html::Input('Vrijeme dolaska', 'time', 'vrijeme', 'vrijeme', null, null, $vrijeme) ?>
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
			<div class='large-3 medium-6 small-6 columns'>
				<?= Html::Input('Napomena', 'text', 'napomena', 'napomena', null, null, $pocetakZadnjegSetaTerapija) ?>
			</div>
			<div class='large-3 medium-12 small-12 columns'>
				<button type='button' class='siroko success spremi round button' onclick='dodajNaListuZaZvati()'>Dodaj</button>
			</div>
		</div>
		<?php	
			if(!empty($nalazi)){
				echo "<h5 class='mb15 mt30'><b><u>Nalazi</u></b></h5>";	
				foreach ($nalazi as $nalaz) {
					echo "<div class='row'><div class='large-12 columns'><div class='panel' style='border: 1px solid black;'>";
					echo "<p><i><b>Datum pregleda:</i></b> " . Alati::datum($nalaz->datum) . "</p>";	
					echo "<p><i><b>Liječnička dijagnoza:</i></b> " . $nalaz->lDijagnoza . "</p>";	
					echo "<p><i><b>Plan fizioterapije:</i></b> " . $nalaz->plan . "</p>";	
					echo "</div></div></div>";
				}	
				
			}else{
				echo "Nema nalaza ovog pacijenta.";
			}
		?>
		</fieldset>
		
	</div>
	<?php } ?>
</div>

<?php
include_once '../masters/masterBottom.php';
?>

