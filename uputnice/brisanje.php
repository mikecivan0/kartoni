<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

if(!isset($_GET["osoba_id"]) || !isset($_GET["datum"])){
	header('location: ../osobe/pacijenti.php');
}else{

	include_once '../alati/Html.php';
	include_once '../alati/Alati.php';
	include_once '../klase/SQL.php';
	include_once '../klase/Uputnica.php';
	include_once '../klase/Pacijent.php';

	$uputnica = new Uputnica();
	$uputnica->setOsobaId($_GET["osoba_id"]);
	$uputnica->setDatum($_GET["datum"]);
	$uputnica->findByOIdAndDate();

	if(strlen($uputnica->datum)==0){
		header('location: ../osobe/pacijenti.php');
	}else{
			
		$pacijent = new Pacijent();
		$pacijent->setId($_GET["osoba_id"]);
		$pacijent->findById();

		if(isset($_GET["brisanje"])){
			$uputnica->setOsobaId($_GET["osoba_id"]);
			$uputnica->setDatum($_GET["datum"]);

			$uputnica->delete();
			header('location: ../osobe/pacijenti.php?id=' . $pacijent->id);

		}

		$title = 'Brisanje uputnice';
		$bodyClass = 'vjezbe';
		include_once '../masters/masterHead.php';
		include_once '../masters/izbornik.php';
		?>
		<div class="row mt40 polja">
			<div class="large-12 columns">
				<form action='<?= $_SERVER["PHP_SELF"] . "?osoba_id=" . $pacijent->id . "&datum=" . $uputnica->datum  . "&brisanje" ?>' method='POST'>
					<fieldset class="polja">
						<legend class="hide-for-small-only">
							Brisanje uputnice
						</legend>
						<legend style="font-size:4vw;" class="show-for-small-only">
							Brisanje uputnice
						</legend>	
						<div class="row mt40">
							<div class="large-4 columns">
								<?= Html::Input('Datum', 'text', null, null, null, null, $uputnica -> datum, array('readonly'=>true)) ?>
							</div>							
							<div class='large-4 columns'>
								<a href="index.php?osoba_id=<?= $pacijent->id ?>&datum=<?= $uputnica->datum ?>">
									<?= Html::Button('Odustani', array('siroko', 'round', 'button', 'spremi')) ?>
								</a>
							</div>	
							<div class='large-4 columns'>
								<?= Html::Submit('Obriši', array('siroko', 'alert', 'spremi', 'round', 'button')) ?>
							</div>	
						</div>	
					</fieldset>
				</form>
			</div>
		</div>

		<?php
		include_once '../masters/masterBottom.php';
	}
}
?>

