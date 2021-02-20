<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';
include_once '../klase/SQL.php';
include_once '../klase/Filter.php';


Auth::isAuth($ida, $putanjaApp);

$title = 'Filteri';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

$filter = new Filter($putanjaApp);

$smallLegentStyle = 'style="font-size: 4vw;" class="show-for-small-only"';
$smallLegentStyle2 = 'style="font-size: 4vw; height: 4rem !important; line-height: 1.4rem !important; padding-top: 0.6rem;" class="show-for-small-only"';
?>
<div class="row mt40 polja">

	<div class="large-12 columns">
		<fieldset>
			<legend class="hide-for-small-only">Osobe sa istim MBO</legend>
			<legend <?= $smallLegentStyle ?>>Osobe sa istim MBO</legend>
			<?php $filter->dupliMBO(); ?>
		</fieldset>	
		<fieldset>
			<legend class="hide-for-small-only">Osobe sa istim brojem dopunskog osiguranja</legend>
			<legend <?= $smallLegentStyle2 ?>>Osobe sa istim brojem dopunskog osiguranja</legend>
			<?php $filter->dupliDO(); ?>
		</fieldset>	
		<fieldset>
			<legend class="hide-for-small-only">Kartoni sa istim brojem upisa</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni sa istim brojem upisa</legend>
			<?php $filter->dupliUpis(); ?>
		</fieldset>		
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisanog broja upisa</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisanog broja upisa</legend>
			<?php $filter->upis(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni sa neispravnim brojem upisa</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni sa neispravnim brojem upisa</legend>
			<?php $filter->neispravanUpis(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisane liječničke dijagnoze</legend>
			<legend <?= $smallLegentStyle2 ?>>Kartoni bez upisane liječničke dijagnoze</legend>
			<?php $filter->lijecnickaDg(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisane funkcionalne dijagnoze</legend>
			<legend <?= $smallLegentStyle2 ?>>Kartoni bez upisane funkcionalne dijagnoze</legend>
			<?php $filter->funkcionalnaDg(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisane početne procjene</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisane početne procjene</legend>
			<?php $filter->pocetnaProcjena(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisanih ciljeva</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisanih ciljeva</legend>
			<?php $filter->cilj(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisanog plana terapije</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisanog plana terapije</legend>
			<?php $filter->plan(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisanog zaključka</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisanog zaključka</legend>
			<?php $filter->zakljucak(); ?>
		</fieldset>		
		<fieldset>
			<legend class="hide-for-small-only">Kartoni koji u početnoj procjeni nemaju upisan dobar format datuma</legend>
			<legend <?= $smallLegentStyle2 ?>>Kartoni koji u početnoj procjeni nemaju upisan dobar format datuma</legend>
			<?php $filter->datumPD(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni koji u zaključku nemaju upisan dobar format datuma</legend>
			<legend <?= $smallLegentStyle2 ?>>Kartoni koji u zaključku nemaju upisan dobar format datuma</legend>
			<?php $filter->datumZakljucka(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni bez upisanih datuma terapija</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni bez upisanih datuma terapija</legend>
			<?php $filter->dolasci(); ?>
		</fieldset>
		<fieldset>
			<legend class="hide-for-small-only">Kartoni kojih nema</legend>
			<legend <?= $smallLegentStyle ?>>Kartoni kojih nema</legend>
			<?php $filter->nedostaje(); ?>
		</fieldset>
	</div>

</div>

<?php
include_once '../masters/masterBottom.php';
?>

