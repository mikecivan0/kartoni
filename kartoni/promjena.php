<?php
if(!isset($_GET["id"])&&!$_POST){
	header("location: index.php");
}else{	
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';
include_once '../klase/Karton.php';
include_once '../klase/Terapija.php';
include_once '../klase/Mjera.php';

$pacijent = new Pacijent();
$karton = new Karton();

//povlačenje podataka kartona
$karton->setId($_GET["id"]);
$karton->findById();

//povlačenje podataka pacijenta
$pacijent->setId($karton->osoba_id);
$pacijent->findById();


if($_POST){
	
	$pacijent->setId($_POST["hfOsobaId"]);
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
		
		$karton->setId($_POST["hfKartonId"]);
		$karton->setUpis($_POST["upis"]);
		$karton->setLDg($_POST["lDijagnoza"]);
		$karton->setFDg($_POST["fDijagnoza"]);
		$karton->setPDg($_POST["pDijagnoza"]);
		$karton->setVazniPodaci($_POST["vazniPodaci"]);
		$karton->setCiljevi($_POST["ciljevi"]);
		$karton->setPlan($_POST["plan"]);
		$karton->setZabiljeske($_POST["zabiljeske"]);
		$karton->setZakljucak($_POST["zakljucak"]);
		$karton->update();
	}
}


$_POST["spol"] = $pacijent->spol; //da se prikaže dobra vrijednost ako nije post
$spolPacijenta = ($pacijent->spol==1) ? "pacijenta" : "pacijentice";

//nalaženje unešenih mjera
$mjere = new Mjera();
$mjere->setOsobaId($pacijent->id);

//dohvaćanje terapija
$th = new Terapija();
$th->setKartonId($karton->id);
$terapije = $th->findByCard();

$pt = (isset($_COOKIE["datumPrveTh"])) ? $_COOKIE["datumPrveTh"] : null;
$zt = (isset($_COOKIE["datumZadnjeTh"])) ? $_COOKIE["datumZadnjeTh"] : null;

$footerScript .= '<script src="' . $putanjaApp . 'js/cookie.js"></script>
				  <script src="' . $putanjaApp . 'js/kartoni/promjena.js"></script>';
if(isset($_GET["focus"])&&$_GET["focus"]=='upis'){
	$footerScript .= '<script src="' . $putanjaApp . 'js/kartoni/focusUpis.js"></script>';
}
$title = 'Fizioterapeutski karton';
$bodyClass = 'vjezbe';

include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

$tab = (isset($_GET["tab"])) ? "&tab=" . $_GET["tab"] : null; 
?>
<div class="row mt40">
	<div class="large-12 columns">
		<form id="formKartona" method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $karton->id  . $tab ?>" class="mt40">	
			<fieldset class="polja">
				<legend class="hide-for-small-only">
					<i> <?=$pacijent->prezime . " " . $pacijent->ime ?>, karton <?= $karton->upis ?></i>
				</legend>
				<legend style="font-size:4vw;" class="show-for-small-only">
					<i> <?=$pacijent->prezime . " " . $pacijent->ime ?>, karton <?= $karton->upis ?></i>
				</legend>
				<div class="row">
					<div class="large-12 columns">
					<?php 
						$karton->findOtherCards($putanjaApp);
					?>
					</div>
				</div>
				 <?= Html::Input(null, 'hidden', 'hfKartonId', 'hfKartonId', null, null, $karton->id, null, false) ?>
				 <?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId', null, null, $pacijent->id, null, false) ?>
				 <?= Html::Input(null, 'hidden', 'putanjaApp', 'putanjaApp', null, null, $putanjaApp, null, false) ?>

				<div class="row mt40 mb40">
					<div class="large-8 large-centered columns">
						<ul class="tabs" data-tab>
						  <li class="tab-title<?= (!isset($_GET["tab"])) ? " active" : null ?>"><a href="#osnovniPodaci">Osnovni podaci</a></li>
						  <li class="tab-title<?= (isset($_GET["tab"])&&$_GET["tab"]=="ostaliPodaci") ? " active" : null ?>"><a href="#ostaliPodaci">Ostali podaci</a></li>
						  <li class="tab-title<?= (isset($_GET["tab"])&&$_GET["tab"]=="datumiTerapija") ? " active" : null ?>"><a href="#datumiTerapija">Datumi terapija</a></li>
						  <li class="tab-title<?= (isset($_GET["tab"])&&$_GET["tab"]=="mjere") ? " active" : null ?>"><a href="#mjere">Mjere</a></li>
						</ul>
					</div>
				</div>
				<div class="tabs-content">
  					<div class="content<?= (!isset($_GET["tab"])) ? " active" : null ?>" id="osnovniPodaci">
				   		<?php
				   			include_once 'osnovniPodaci.php';
				   		?>
				    </div>
				    <div class="content<?= (isset($_GET["tab"])&&$_GET["tab"]=="ostaliPodaci") ? " active" : null ?>" id="ostaliPodaci">
						<?php
				   			include_once 'ostaliPodaci.php';
				   		?>	
				    </div>
				    <div class="content<?= (isset($_GET["tab"])&&$_GET["tab"]=="datumiTerapija") ? " active" : null ?>" id="datumiTerapija">
						<?php
				   			include_once 'datumiTerapija.php';
				   		?>	
				    </div>
				     <div class="content<?= (isset($_GET["tab"])&&$_GET["tab"]=="mjere") ? " active" : null ?>" id="mjere">
						<?php
				   			include_once 'mjere.php';
				   		?>	
				    </div>
					
				 </div>
		
			 	<div class="row mb40 mt40">
			 		<div class="large-4 columns">
						<?= Html::Button('Kopiraj podatke (nastavak th)', array('siroko', 'secondary', 'spremi', 'round', 'button', 'kopiranje')) ?>
					</div>
					<div class="large-4 columns">
						<?= Html::Submit('Spremi promjene kartona', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
					</div>
					<div class="large-4 columns">
						<?= Html::Button('Obriši karton', array('siroko', 'alert', 'spremi', 'round', 'button', 'brisanjeKartona')) ?>
					</div>
				</div>
			</fieldset>			
		</form>	
		<?php
			include_once 'modalTerapije.php';
		?>	
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
}
?>