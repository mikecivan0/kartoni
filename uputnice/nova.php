<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

if(!isset($_GET["osoba_id"])){
	header('location: ../osobe/pacijenti.php');
}else{

	include_once '../alati/Html.php';
	include_once '../alati/Alati.php';
	include_once '../klase/SQL.php';
	include_once '../klase/Uputnica.php';
	include_once '../klase/Pacijent.php';

	$pacijent = new Pacijent();
	$pacijent->setId($_GET["osoba_id"]);
	$pacijent->findById();

	$uputnica = new Uputnica();
	
	if($_POST){		
			
		$uputnica->setOsobaId($_GET["osoba_id"]);
		$uputnica->setDatum($_POST["datum"]);
		
		$greske = $uputnica->provjera();		
	
		if(empty($greske)){
			$uputnica->insert();
			header('location: ../osobe/pacijenti.php?id=' . $pacijent->id);
		}

	}

	$title = 'Nova uputnica';
	$bodyClass = 'vjezbe';
	include_once '../masters/masterHead.php';
	include_once '../masters/izbornik.php';
	?>
	<div class="row mt40 polja">
		<div class="large-12 columns">
			<form action='<?= $_SERVER["PHP_SELF"] . "?osoba_id=" . $pacijent->id ?>' method='POST'>
				<fieldset class="polja">
					<legend class="hide-for-small-only">
						Nova uputnica
					</legend>
					<legend style="font-size:4vw;" class="show-for-small-only">
						Nova uputnica
					</legend>	
					<div class="row mt40">
						<div class="large-4 columns">
							<?= Html::InputSaGreskom($greske, 'datum', 'Datum', null, 'date') ?>
						</div>							
						<div class='large-4 columns'>
						<?= Html::Submit('Unesi', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
						</div>
						<div class='large-4 columns'>
							<a href="../osobe/pacijenti.php?id=<?= $pacijent->id ?>">
								<?= Html::Button('Odustani', array('siroko', 'round', 'button', 'spremi')) ?>
							</a>
						</div>	
					</div>	
				</fieldset>
			</form>
		</div>
	</div>
	<?php
		include_once '../masters/masterBottom.php';
}
?>

