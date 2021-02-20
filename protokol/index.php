<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../klase/SQL.php';
include_once '../klase/Karton.php';
include_once '../alati/Alati.php';

$stranica = (isset($_GET["stranica"])) ? $_GET["stranica"] : 1;
$redoslijed = (isset($_GET["redoslijed"])) ? $_GET["redoslijed"] : "desc";

$selectedAsc = ($redoslijed=="asc") ? " selected" : null;
$selectedDesc = ($redoslijed=="desc") ? " selected" : null;

$karton = new Karton();
$protokol = $karton->protokol($stranica,$redoslijed);
$kartoni = $protokol[0];
$ukupnoStranica = $protokol[1];
$stranica = ($stranica>$ukupnoStranica) ? $ukupnoStranica : $stranica;

$title = 'Protokol';
$bodyClass = 'vjezbe';
$footerScript .= '<script src="' . $putanjaApp . 'js/protokol/index.js"></script>';

include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	 <?= Html::Input(null, 'hidden', 'hfStranica', 'hfStranica', null, null, $stranica, null, false) ?>
	 <?= Html::Input(null, 'hidden', 'hfRedoslijed', 'hfRedoslijed', null, null, $redoslijed, null, false) ?>
	<div class="large-12 columns center">
		<h3 class="plavaSlova"><i>Protokol</i></h3>
	</div>
	
	<?php include 'paginacija.php'; ?>
	
	<div class="large-3 columns end">
		<label><b>Raspored prikaza</b></label>
		<select name="redoslijed" id="redoslijed">
			<option value="asc"<?= $selectedAsc ?>>Od početka prema kraju</option>
			<option value="desc"<?= $selectedDesc ?>>Od kraja prema početku</option>
		</select>
	</div>
	
	<hr>
	
	<div class="large-12 columns mt20">	
		<?php 
			foreach($kartoni as $kartonPodaci){	
				$ukupnoDana = $kartonPodaci->ukupnoDana;
				if($ukupnoDana==0){
					$datumi = "nema upisanih terapija";
				}elseif($ukupnoDana==1){
					$datumi = Alati::datum($kartonPodaci->prvaTh). " (1 dan)";
				}else{
					$datumi = Alati::datum($kartonPodaci->prvaTh) . '-' . Alati::datum($kartonPodaci->zadnjaTh) . " (" . $ukupnoDana . " dana)";
				}
				
				echo "<div class='large-12 columns'>";
				echo '<a href="../kartoni/promjena.php?id=' . $kartonPodaci->id . '" target="_blank"><b>' . $kartonPodaci->upis . '.</b> ' .
					 $kartonPodaci->prezime . ' ' . $kartonPodaci->ime . ', ' . $datumi; 
				echo "</a></div>";
			}
		
		?>
	</div>	
	
	<?php include 'paginacija.php'; ?>
</div>
<?php
include_once '../masters/masterBottom.php';
?>

