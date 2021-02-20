<?php
include_once '../../config/conf.php';
include_once '../../kontrole/Auth.php';

Auth::isRoot($ida, $putanjaApp);

include_once '../../klase/SQL.php';
include_once '../../klase/NeradniDan.php';
include_once '../../alati/Html.php';

$neradniDan = new NeradniDan();
$neradniDan->get();


if($_POST){
		
	$neradniDan->setStariDatumi($_POST["hfStariDatumi"]);
	$neradniDan->setNoviDatumi($_POST["noviDatumi"]);

	$neradniDan->update();
}

$title = 'Datumi neradnih dana';
$bodyClass = 'vjezbe';
include_once '../../masters/masterHead.php';
include_once '../../masters/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns mt40 polja">	
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<?= Html::Input(null, 'hidden','hfStariDatumi', 'hfStariDatumi', null, null, $neradniDan -> stariDatumi) ?>
			<fieldset>
				<legend>Popis neradnih dana</legend>			
				<div class="row mt40">
					<div class="large-12 columns">
						<?= Html::Textarea('Neradni dani', 'noviDatumi', 'noviDatumi', null, null, $neradniDan -> noviDatumi, array("rows"=>10)) ?>
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

