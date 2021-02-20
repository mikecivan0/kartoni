<?php
include_once '../../config/conf.php';
include_once '../../kontrole/Auth.php';

Auth::isRoot($ida, $putanjaApp);

include_once '../../klase/SQL.php';
include_once '../../klase/Korisnik.php';
include_once '../../alati/Html.php';

$korisnik = new Korisnik();
$korisnik->setId($_GET["id"]);
$korisnik->findById();

if(strlen($korisnik->razina)==0){
	header('location: index.php');
}else{

	if(isset($_POST["hfId"])){
	
		$korisnik->delete();
		header('location: index.php');

	}

	$_POST["razina"] = $korisnik->razina;
	$title = 'Brisanje korisnika';
	$bodyClass = 'vjezbe';
	include_once '../../masters/masterHead.php';
	include_once '../../masters/izbornik.php';
	?>
	<div class="row">
		<div class="large-12 columns mt40 polja">	
			<form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $korisnik -> id ?>" method="POST">
			<?= Html::Input(null, 'hidden', 'hfId', 'hfId', null, null, $korisnik -> id) ?>
				<fieldset>
					<legend>Brisanje korisnika <?= $korisnik->username ?></legend>	
					<div class="row mt40">
						<div class="large-4 columns end">
							<?= Html::Input('Korisničko ime', 'text', null, null, null, null, $korisnik -> username, array('readonly'=>true)) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns end">
							<?= Html::Input('Razina', 'text', null, null, null, null, $korisnik -> razina, array('readonly'=>true)) ?>							
						</div>
					</div>
					
					<div class='row mt40'>	
						<div class='large-4 columns'>
							<span class="red">Klikom na gumb <b>Obriši korisnika</b> pokreće se brisanje ovoga korisnika. Brisanje je nepovratno.</span>		
						</div>
						<div class='large-4 columns'>
							<?= Html::Submit('Obriši korisnika', array('siroko', 'alert', 'spremi', 'round', 'button')) ?>
						</div>
						<div class='large-4 columns'>
							<a href="index.php">
								<?= Html::Button('Odustani', array('siroko', 'round', 'button', 'spremi')) ?>
							</a>
						</div>
					</div>
				</fieldset>
			</form>		
		</div>
	</div>

	<?php 
	include_once '../../masters/masterBottom.php';
}
?>

