<?php
include_once '../../config/conf.php';
include_once '../../kontrole/Auth.php';

Auth::isRoot($ida, $putanjaApp);

include_once '../../klase/SQL.php';
include_once '../../klase/Protokol.php';
include_once '../../alati/Html.php';

$protokol = new Protokol();
$protokol->nemaUProtokolu();


if($_POST){
		
	$protokol->setStariBrojevi($_POST["hfStariBrojevi"]);
	$protokol->setNoviBrojevi($_POST["noviBrojevi"]);

	$protokol->update();
}

$title = 'Brojevi kojih nema u protokolu';
$bodyClass = 'vjezbe';
include_once '../../masters/masterHead.php';
include_once '../../masters/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns mt40 polja">	
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<?= Html::Input(null, 'hidden','hfStariBrojevi', 'hfStariBrojevi', null, null, $protokol -> stariBrojevi) ?>
			<fieldset>
				<legend>Brojevi kojih nema u protokolu</legend>			
				<div class="row mt40">
					<div class="large-12 columns">
						<?= Html::Textarea('Brojevi kojih nema protokolu', 'noviBrojevi', 'noviBrojevi', null, null, $protokol -> noviBrojevi, array("rows"=>5)) ?>
					</div>
				</div>				
				<div class='row mt40'>
					<div class='large-12 columns'>
						<?= Html::Submit('Spremi izmjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
					</div>
				</div>
			</fieldset>
		</form>		
	</div>
</div>

<?php 
include_once '../../masters/masterBottom.php';

?>

