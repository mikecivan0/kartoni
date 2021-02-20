<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';

$footerScript .= '<script src="' . $putanjaApp . 'js/turnus/index.js"></script>';
$title = 'Izbor vremenskog okvira';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	<div class="large-12 columns">	
		<form id="izborDatuma" target="_blank" method="POST" action="ispisKartonaGrupe.php" class="mt40">	
				<fieldset class="polja">
					<p class="red mt20">*upišite datume vremenskog okvira unutar kojeg je ciljana grupa (čije kartone želite ispisati) dolazila na terapije</p>
					<p class="red">*vremenski okvir ne smije prelaziti 14 dana</p>
					<p class="red mb20">*priprema ispisa može potrajati nekoliko minuta</p>
					<legend><?= $title ?></legend>
					<div class="large-4 columns">
						<?= Html::Input('Od datuma', 'date', 'odDatuma', 'odDatuma') ?>	
					</div>
					<div class="large-4 columns">
						<?= Html::Input('Do datuma', 'date', 'doDatuma', 'doDatuma') ?>	
					</div>
					<div class="large-4 columns">
						<button type='button' class='siroko success spremi round button'>Ispis</button>
					</div>
				</fieldset>
		</form>
	</div>	
</div>
<?php
include_once '../masters/masterBottom.php';
?>

