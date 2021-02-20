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


		if($_POST){
			
			$uputnica->setNoviDatum($_POST["datum"]);		
			$uputnica->setOsobaId($_GET["osoba_id"]);
			$uputnica->setDatum($_GET["datum"]);	
			
			$greske = $uputnica->provjeraPrijeIzmjene();		
	
			if(empty($greske)){			
			
				$uputnica->update();
				header('location: ../osobe/pacijenti.php?id=' . $pacijent->id);
			}

		}

		$title = 'Datum uputnice';
		$bodyClass = 'vjezbe';
		include_once '../masters/masterHead.php';
		include_once '../masters/izbornik.php';
		?>
		<div class="row mt40 polja">
			<div class="large-12 columns">
				<form action='<?= $_SERVER["PHP_SELF"] . "?osoba_id=" . $pacijent->id . "&datum=" . $uputnica->datum ?>' method='POST'>
					<fieldset class="polja">
						<legend class="hide-for-small-only">
							Datum uputnice
						</legend>
						<legend style="font-size:4vw;" class="show-for-small-only">
							Datum uputnice
						</legend>	
						<div class="row mt40">
							<div class="large-3 columns">
								<?= Html::InputSaGreskom($greske, 'datum', 'Datum', $uputnica->datum, 'date') ?>
							</div>							
							<div class='large-3 columns'>
								<?= Html::Submit('Spremi izmjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
							</div>
							<div class='large-3 columns'>
								<a href="../osobe/pacijenti.php?id=<?= $pacijent->id ?>">
									<?= Html::Button('Odustani', array('siroko', 'round', 'button', 'spremi')) ?>
								</a>
							</div>	
							<div class='large-3 columns'>
								<a href="brisanje.php?osoba_id=<?= $pacijent->id ?>&datum=<?= $uputnica->datum ?>">
									<?= Html::Button('Brisanje uputnice', array('siroko', 'alert', 'round', 'button', 'spremi')) ?>
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
}
?>

