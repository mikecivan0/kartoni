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

	if(isset($_POST["username"])){
		
		$korisnik->setId($_POST["hfId"]);
		$korisnik->setUsername($_POST["username"]);
		$korisnik->setRazina($_POST["razina"]);
		$korisnik->setPassword($_POST["password"]);
		$korisnik->setPasswordAgain($_POST["passwordAgain"]);
		
		$greske = $korisnik->provjeraPrijePromjene();
		
		if(empty($greske)){
			
			$korisnik->update();
			header('location: index.php');
			
		}
	}

	$_POST["razina"] = $korisnik->razina;
	$title = 'Detalji korisnika';
	$bodyClass = 'vjezbe';
	include_once '../../masters/masterHead.php';
	include_once '../../masters/izbornik.php';
	?>
	<div class="row">
		<div class="large-12 columns mt40 polja">	
			<form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $korisnik -> id ?>" method="POST">
			<?= Html::Input(null, 'hidden', 'hfId', 'hfId', null, null, $korisnik -> id) ?>
				<fieldset>
					<legend>Detalji korisnika <?= $korisnik->username ?></legend>			
					<div class="row mt40">
						<div class="large-4 columns end">
							<?= Html::InputSaGreskom($greske, 'username', 'Korisničko ime', $korisnik -> username, 'text') ?>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns end">
						
							<?= Html::Select('Razina', 'razina', 'razina', null, array( 
																		array('id' => 'root', 'text' => 'Administrator', 'value' => 'root'), 
																		array('id' => 'doctor', 'text' => 'Doktor', 'value' => 'doctor'),
																		array('id' => 'user', 'text' => 'Korisnik', 'value' => 'user')
																	)
									 ) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns end">
							<?= Html::InputSaGreskom($greske, 'password', 'Lozinka', null, 'password') ?>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns end">
							<?= Html::InputSaGreskom($greske, 'passwordAgain', 'Ponovno lozinka', null, 'password') ?>
						</div>
					</div>
					<div class='row mt40'>
						<div class='large-4 columns'>
							<?= Html::Submit('Spremi izmjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
						</div>
						<div class='large-4 columns'>
							<a href="index.php">
								<?= Html::Button('Odustani', array('siroko', 'round', 'button', 'spremi')) ?>
							</a>
						</div>
						<div class='large-4 columns'>
							<a href="brisanje.php?id=<?= $korisnik->id ?>">
								<?= Html::Button('Brisanje korisnika', array('siroko', 'alert', 'round', 'button', 'spremi')) ?>
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

