<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';
include_once '../klase/Uputnica.php';
include_once '../klase/Karton.php';

$pacijent = new Pacijent();
$uputnica = new Uputnica();
$karton = new Karton();
			

if(isset($_GET["id"])){	
	
	$pacijent->setId($_GET["id"]);
	$pacijent->findById();
	
	$uputnica->setOsobaId($pacijent->id);
	$uputnice = $uputnica->findByOId();
	
	$karton->setOsobaId($_GET["id"]);
	$kartoni = $karton->findByPId();
}

$footerScript .= '<script src="' . $putanjaApp . 'js/pacijenti/index.js"></script>';
$title = 'Detalji pacijenata';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	
	<div class="large-12 columns center">
		<h3 class="plavaSlova"><i>Pronađite detalje pacijenata</i></h3>
	</div>
	<hr>
	
	<div class="large-8 end columns">
		<?= Html::Input('<b>Pretraga pacijenata</b> (pretraga po imenu i/ili prezimenu ili MBO-u pacijenta)', 'text', 'pacijent', 'pacijent', null, null, null, array('autofocus'=>'autofocus')) ?>
	</div>
		<?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId', null, null, $pacijent->id, null, false) ?>		
	<hr />
	
	<?php if($pacijent->ime!=""){ ?>
	<div class="large-12 columns">
		<fieldset class="polja">
			<legend class="hide-for-small-only">
				Detalji osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
			</legend>
			<legend style="font-size:4vw;" class="show-for-small-only">
				Detalji osobe <?= $pacijent->ime . " " . $pacijent->prezime ?>
			</legend>	
			<div class="row mb40">
				<div class="large-4 columns">
					<a target="_blank" href="ispisSumiranja.php?id=<?= $pacijent->id ?>">
						<?= Html::Button('Ispis svih kartona pacijenta', array('siroko', 'primary', 'round', 'button')) ?>
					</a>
				</div>
				<div class="large-4 columns end">
					<a href="promjena.php?id=<?= $pacijent->id ?>">
						<?= Html::Button('Izmjena podataka pacijenta', array('siroko', 'success', 'round', 'button')) ?>
					</a>
				</div>
			</div>
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
			echo "<p>Datumi D1 uputnica: <b>" . $uputnice. "</b>";
			echo "<span>
					<a href='../uputnice/nova.php?osoba_id=" . $pacijent->id . "' style='color: green; font-size: 0.8rem; padding-left: 10px;'>
						Dodaj uputnicu
					</a>
				  </span>";
			echo "</p>";
			
			if(!empty($kartoni)){
				echo "<h5 class='mt40'>Kartoni</h5>";
				echo "<ol>";
					
				foreach ($kartoni as $karton) {
					
					$prvaTh = ($karton->prvaTh=="nema upisanih terapija") ? $karton->prvaTh : Alati::datum($karton->prvaTh);
					$zadnjaTh = ($karton->zadnjaTh=="nema upisanih terapija") ? "" : " - " . Alati::datum($karton->zadnjaTh);
					
					echo "<li>
							<a target='_blank' href='" . $putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "'>
								Broj upisa: <b>" . $karton->upis . "</b>, terapija provedena <b>" . $prvaTh . $zadnjaTh . "</b>
							</a>
						</li>";
				}
			
				echo "</ol>";
				echo "<div class='row'><div class='large-4 columns'>";
				echo Html::Button('Kreiraj prazan karton', array('siroko', 'primary', 'spremi', 'round', 'button', 'kreirajKarton'));				
				echo "</div>";
				echo "<div class='large-4 columns end'>";
				echo Html::Button('Osvježi podatke', array('siroko', 'secondary', 'spremi', 'round', 'button', 'osvjezi'));
				echo "</div></div>";
			}else{
				echo "<h5 class='mt40 red'>Nema otvorenih kartona</h5>";
				echo "<div class='row'><div class='large-4 columns'>";
				echo Html::Button('Kreiraj prazan karton', array('siroko', 'primary', 'spremi', 'round', 'button', 'kreirajKarton'));				
				echo "</div>";
				echo "<div class='large-4 columns end'>";
				echo Html::Button('Obriši pacijenta', array('siroko', 'alert', 'spremi', 'round', 'button', 'brisanjePacijenta'));				
				echo "</div></div>";
			}			
		?>
		</fieldset>
		
	</div>
	<?php } ?>
</div>

<?php
include_once '../masters/masterBottom.php';
?>

