<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isDoctorOrRoot($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Pacijent.php';
include_once '../klase/Mjera.php';

$ispisMjera = null;
$pacijent = new Pacijent();

if(isset($_GET["id"])){		
	$pacijent->setId($_GET["id"]);
	$pacijent->findById();
	
	$mjere = new Mjera();
	$mjere->setOsobaId($pacijent->id);
	$ispisMjera = $mjere->ispisMjera($doktorica=true);
}

$footerScript .= '<script src="' . $putanjaApp . 'js/doctor/index.js"></script>
<script src="' . $putanjaApp . 'js/doctor/jquery.copiq.js"></script>
<script src="' . $putanjaApp . 'js/doctor/kopirajZadnjeMjere.js"></script>';

$title = 'Detalji pacijenta';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja mb40">
	
	<div class="large-12 columns center">
		<h3 class="plavaSlova"><i>Pronađite detalje pacijenta</i></h3>
	</div>
	<hr>
	
	<div class="large-8 end columns">
		<?= Html::Input('<b>Pretraga pacijenata</b> (pretraga po imenu i/ili prezimenu ili MBO-u pacijenta)', 'text', 'pacijent', 'pacijent', null, null, null, array('autofocus'=>'autofocus')) ?>
	</div>
		
	<hr />
	
	<?php if(!empty($pacijent->ime)){ ?>
	<div class="large-12 pt15 plr35 pb40 columns">
		
		<?php			
			include_once '../klase/Karton.php';
			
			$lDijagnoze = array();
			$planovi = array();
			$zabiljeske = array();
			$zakljucci = array();
			$prviIZadnjiDatumiTerapija = array();
			
			$kartoni = new Karton();
			$kartoni->setOsobaId($pacijent->id);
			$kartoni = $kartoni->findByPId($pacijent->id);
			echo "<p class='lhDetalji mt20'><i>Ime i prezime: </i><b>" . $pacijent->ime . " " . $pacijent->prezime . "</b></p>";
			echo "<p class='mb40 lhDetalji'><i>Godište: </i><b> " . $pacijent->godiste . ".</b></p>";
			if(!empty($kartoni)){
								
					
				foreach ($kartoni as $karton) {
					if($karton->lDijagnoza!="" && !in_array($karton->lDijagnoza, $lDijagnoze)) { array_push($lDijagnoze, $karton->lDijagnoza); }
					if($karton->plan!="" && !in_array($karton->plan, $planovi)) { array_push($planovi, $karton->plan); }
					if($karton->zabiljeske!="" && !in_array($karton->zabiljeske, $zabiljeske)) { array_push($zabiljeske, $karton->zabiljeske); }					
					if($karton->zakljucak!="" && !in_array($karton->zakljucak, $zakljucci)) { array_push($zakljucci, $karton->zakljucak); }					
					
					$prvaTh = ($karton->prvaTh=="nema upisanih terapija") ? $karton->prvaTh : Alati::datum($karton->prvaTh);
					$zadnjaTh = ($karton->zadnjaTh=="nema upisanih terapija") ? "" : " - " . Alati::datum($karton->zadnjaTh);					
					$prikazDatumaTerapija = $prvaTh . $zadnjaTh;					
					array_push($prviIZadnjiDatumiTerapija, $prikazDatumaTerapija);	
				}
				
			}
			
			if(!empty($lDijagnoze)){
				echo "<h5 class='lhDetalji'><i>Liječnička dijagnoza</i></h5>";
				echo "<ul>";
				foreach($lDijagnoze as $key => $value) { echo "<li class='lhDetalji'>" . $value . "</li>"; }
				echo "</ul>";
			}
			
			if(!empty($planovi)){
				echo "<h5 class='mt30 lhDetalji'><i>Plan fizioterapije</i></h5>";
				echo "<ul>";
				foreach($planovi as $key => $value) { echo "<li class='lhDetalji'>" . $value . "</li>"; }
				echo "</ul>";
			}
			
			if(!empty($zabiljeske)){
				echo "<h5 class='mt30 lhDetalji'><i>Zabilješke tijekom fizioterapije</i></h5>";
				echo "<ul>";
				foreach($zabiljeske as $key => $value) { echo "<li class='lhDetalji'>" . $value . "</li>"; }
				echo "</ul>";
			}
			
			if(!empty($zakljucci)){
				echo "<h5 class='mt30 lhDetalji'><i>Zaključak po provedenoj fizioterapiji</i></h5>";
				echo "<ul class='mb100'>";
				foreach($zakljucci as $key => $value) { echo "<li class='lhDetalji'>" . $value . "</li>"; }			
				echo "</ul>";
			}			
			
			echo $ispisMjera;
		?>
	
	</div>
	<?php } ?>
</div>

<?php
include_once '../masters/masterBottom.php';
?>

