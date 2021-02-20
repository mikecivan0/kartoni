<?php
include_once '../../config/conf.php';
include_once '../../kontrole/Auth.php';

Auth::isRoot($ida, $putanjaApp);
include_once '../../klase/SQL.php';
include_once '../../klase/Korisnik.php';
include_once '../../alati/Html.php';

$user = new Korisnik();
$korisnici = $user->findAll();

$title = 'Korisnici';
$bodyClass = 'vjezbe';
include_once '../../masters/masterHead.php';
include_once '../../masters/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns mt40 polja">
		<div class="row">
			<div class='large-4 columns'>
				<a href="novi.php">
					<?= Html::Button('Dodavanje novog korisnika', array('siroko', 'round', 'button', 'spremi', 'mt40')) ?>
				</a>
			</div>
		</div>
		<div class="row mt40">
			<fieldset>
				<legend>Popis korisnika</legend>
					<?php if(!empty($korisnici)){ ?>
						<div class="large-6 large-centered columns mt40">
							<table class="siroko">
								<thead>
									<tr>				
										<th class="center">Korisničko ime</th>
										<th class="center">Razina</th>
									</tr>
								</thead>
								<tbody id="podaci">
									<?php					
										foreach ($korisnici as $korisnik){ ?>					
											<tr>
												<td class="center">
													<a href="detalji.php?id=<?= $korisnik->id ?>">
														<?= $korisnik->username ?>
													</a>
												</td>
												<td class="center"><?= $korisnik->razina ?></td>
											
											</tr>					
									<?php } ?>
								</tbody>
							</table>
						<?php 
							}else{
								echo "Nema upisanih korisnika";
							} 
						?>
					</div>
			</fieldset>
	</div>
</div>

<?php 
include_once '../../masters/masterBottom.php';
?>

