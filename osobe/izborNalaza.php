<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';
include_once '../klase/Nalaz.php';

$pacijent = new Pacijent();
$nalaz = new Nalaz();

if(isset($_GET["osoba_id"])){	
	$pacijent->setId($_GET["osoba_id"]);
	$pacijent->findById();
	
	$nalaz->setOsobaId($pacijent->id);
	$nalazi = $nalaz->findByOId();
}

$datumPT = (isset($_COOKIE["datumPT"])) ? $_COOKIE["datumPT"] : null;
$datumZT = (isset($_COOKIE["datumZT"])) ? $_COOKIE["datumZT"] : null;

$title = 'Izbor nalaza';
$bodyClass = 'vjezbe';
$footerScript .= '<script src="' . $putanjaApp . 'js/cookie.js"></script>
				  <script src="' . $putanjaApp . 'js/osobe/izborNalaza.js"></script>';
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
			<legend>Detalji pacijenta <?= $pacijent->ime . " " . $pacijent->prezime ?></legend>		
		<?php	
			
			
			$spol = ($pacijent->spol==1) ? "muško" : "žensko";
			echo "<p>Ime: <b>" . $pacijent->ime . "</b></p>";
			echo "<p>Prezime: <b> " . $pacijent->prezime . "</b></p>";
			echo "<p>Godište: <b> " . $pacijent->godiste . "</b></p>";
			echo "<p>Spol: <b> " . $spol . "</b></p>";
			echo "<p>Zanimanje: <b> " . $pacijent->zanimanje . "</b></p>";
			echo "<p>MBO: <b> " . $pacijent->mbo . "</b></p>";
			echo "<p>Dopunsko: <b> " . $pacijent->dopunsko . "</b></p>";
			echo "<p>Telefon: <b> " . $pacijent->telefon . "</b></p>";
			
			echo "<h6 class='mt40 mb20 red'>
					<i>
						1. Obavezno upišite <b>prvi</b> i <b>zadnji</b> dan terapije. <b>Ne smije</b> biti 
						više od <b>30 dana razlike</b> između tih datuma. <br />
						2. Kliknite na nalaz prema kojem želite kreirati fizioterapeutski karton.
					</i>
				</h6>";
			echo "<div class='row mb20'><div class='large-4 columns'>";
			Html::Input('Datum prvog dana terapije', 'date', 'datumPT', 'datumPT', null, null, $datumPT);
			echo '</div>';
			echo "<div class='large-4 columns end'>";
			Html::Input('Datum zadnjeg dana terapije', 'date', 'datumZT', 'datumZT', null, null, $datumZT);
			echo '</div></div>';
			
			if(!empty($nalazi)){
					
				foreach ($nalazi as $nalaz) {
					echo "<div class='row'><div class='large-12 columns'><div class='panel' onclick='kreirajNalaz(" . $nalaz->id . ")'>";
					echo "<p><i><b>Datum pregleda:</i></b> " . Alati::datum($nalaz->datum) . "</p>";	
					echo "<p><i><b>Liječnička dijagnoza:</i></b> " . $nalaz->lDijagnoza . "</p>";	
					echo "<p><i><b>Funkcionalna dijagnoza:</i></b> " . $nalaz->fDijagnoza . "</p>";	
					echo "<p><i><b>Početna procjena:</i></b> " . $nalaz->pDijagnoza . "</p>";	
					echo "<p><i><b>Podaci važni za fizioterapiju:</i></b> " . $nalaz->vazniPodaci . "</p>";	
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

