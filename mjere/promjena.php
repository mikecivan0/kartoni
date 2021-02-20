<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Mjera.php';
$footerScript .= '<script src="' . $putanjaApp . 'js/mjere/promjena.js"></script>';

$id = ($_GET["id"]) ? $_GET["id"] : $_POST["hfMjereId"];
$nazivMjere = (isset($_GET["nazivMjere"])) ? $_GET["nazivMjere"] : $_POST["hfNazivMjere"];
$osoba_id = (isset($_GET["osoba_id"])) ? $_GET["osoba_id"] : $_POST["hfOsobaId"];
$karton_id = (isset($_GET["karton_id"])) ? $_GET["karton_id"] : $_POST["hfKartonId"];

$mjere = new Mjera();
$mjere->setId($id);
$mjere = $mjere->findById();

if($_POST){
	
	$updateMjera = new Mjera();
	$updateMjera->setOsobaId($osoba_id);
	$updateMjera->setId($id);
	$updateMjera->setBolesnaStrana($_POST["bolesnaStrana"]);
	$updateMjera->setDatum($_POST["datumMjerenja"]);
	$rezultat = $updateMjera->provjeraPrijePromjene();
	
	if($rezultat){
		$updateMjera->update();
		header('location: ' . $putanjaApp . 'kartoni/promjena.php?id=' . $karton_id . '&tab=mjere');	
	}else{
		$footerScript .= '<script src="' . $putanjaApp . 'js/mjere/imaMjera.js"></script>';
	}
	
}

$_POST["bolesnaStrana"] = $mjere->bolesnaStrana; //radi selecta

$title = 'Promjena mjera';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';
?>
<div class="row mt40 polja">
	<?php	
		
		if(!empty($mjere)){				
	?>
	<div class="large-12 columns">
		<form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $id . "&karton=" . $karton_id ?>" method="POST">
			<?= Html::Input(null, 'hidden', 'hfMjereId', 'hfMjereId', null, null, $id, null, false) ?>
			<?= Html::Input(null, 'hidden', 'hfOsobaId', 'hfOsobaId', null, null, $osoba_id, null, false) ?>
			<?= Html::Input(null, 'hidden', 'hfNazivMjere', 'hfNazivMjere', null, null, $nazivMjere, null, false) ?>
			<?= Html::Input(null, 'hidden', 'hfKartonId', 'hfKartonId', null, null, $karton_id, null, false) ?>
			<?= Html::Input(null, 'hidden', 'putanjaApp', 'putanjaApp', null, null, $putanjaApp, null, false) ?>
			<fieldset class="polja">
				<legend>Promjena mjera</legend>		
			
				<div class="row">
					<div class="large-3 medium-12 small-12 columns mb40">
						<?= Html::Input('Datum mjerenja', 'date', 'datumMjerenja', 'datumMjerenja', null, null, $mjere->datum) ?>
					</div>
					<div class="large-3 medium-12 small-12 end columns mb40">
						<?= Html::Select('Bolesna strana', 'bolesnaStrana', 'bolesnaStrana', null, array(
														array('id'=>'lijeva','text'=>'lijeva','value'=>'1'),
														array('id'=>'desna','text'=>'desna','value'=>'2'),
														array('id'=>'obje','text'=>'obje','value'=>'3')
														)
										) ?>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns mt40">
						<div class="large-6 medium-6 small-6 columns">
							<h3 class="text_lijevo">Lijevo</h3>
						</div>
						 <div class="large-6 medium-6 small-6 columns">
							<h3 class="text_desno">Desno</h3>
						</div>
					</div>
				</div>
				<ul class="accordion" data-accordion role="tablist">
					<li class="accordion-navigation">
						<a href="#cirkumferencije" role="tab" id="cirkumferencije-heading" aria-controls="cirkumferencije">Cirkumferencije i dinamometrija</a>
						<div id="cirkumferencije" class="content" role="tabpanel" aria-labelledby="cirkumferencije-heading">
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Nadlaktica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Na polazištu m. deltoideusa
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPolazisteDeltoideusa', 'lPolazisteDeltoideusa', null, null, $mjere->lPolazisteDeltoideusa, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPolazisteDeltoideusa', 'dPolazisteDeltoideusa', null, null, $mjere->dPolazisteDeltoideusa, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Na hvatištu m. deltoideusa
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lHvatisteDeltoideusa', 'lHvatisteDeltoideusa', null, null, $mjere->lHvatisteDeltoideusa, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dHvatisteDeltoideusa', 'dHvatisteDeltoideusa', null, null, $mjere->dHvatisteDeltoideusa, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Po sredini nadlaktice
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSredinaNadlaktice', 'lSredinaNadlaktice', null, null, $mjere->lSredinaNadlaktice, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSredinaNadlaktice', 'dSredinaNadlaktice', null, null, $mjere->dSredinaNadlaktice, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Lakat</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko olekranona
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoOlekranona', 'lPrekoOlekranona', null, null, $mjere->lPrekoOlekranona, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoOlekranona', 'dPrekoOlekranona', null, null, $mjere->dPrekoOlekranona, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko olekranona
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoSredinePodlaktice', 'lPrekoSredinePodlaktice', null, null, $mjere->lPrekoSredinePodlaktice, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoSredinePodlaktice', 'dPrekoSredinePodlaktice', null, null, $mjere->dPrekoSredinePodlaktice, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko ručnog zgloba
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoRucnogZgloba', 'lPrekoRucnogZgloba', null, null, $mjere->lPrekoRucnogZgloba, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoRucnogZgloba', 'dPrekoRucnogZgloba', null, null, $mjere->dPrekoRucnogZgloba, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko MCP zgloba
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoMetacarpusa', 'lPrekoMetacarpusa', null, null, $mjere->lPrekoMetacarpusa, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoMetacarpusa', 'dPrekoMetacarpusa', null, null, $mjere->dPrekoMetacarpusa, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Opseg prsta
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lOPrsta', 'lOPrsta', null, null, $mjere->lOPrsta, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dOPrsta', 'dOPrsta', null, null, $mjere->dOPrsta, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Natkoljenica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									15 cm iznad gornjeg ruba patele
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'l15IznadPatele', 'l15IznadPatele', null, null, $mjere->l15IznadPatele, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'd15IznadPatele', 'd15IznadPatele', null, null, $mjere->d15IznadPatele, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Koljeno</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko sredine patele
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoPatele', 'lPrekoPatele', null, null, $mjere->lPrekoPatele, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoPatele', 'dPrekoPatele', null, null, $mjere->dPrekoPatele, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Potkoljenica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									15 cm ispod donjeg ruba patele
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'l15IspodPatele', 'l15IspodPatele', null, null, $mjere->l15IspodPatele, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'd15IspodPatele', 'd15IspodPatele', null, null, $mjere->d15IspodPatele, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Skočni zglob</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko maleola
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoMaleola', 'lPrekoMaleola', null, null, $mjere->lPrekoMaleola, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoMaleola', 'dPrekoMaleola', null, null, $mjere->dPrekoMaleola, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko pete pod kutom od 45°
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoPete', 'lPrekoPete', null, null, $mjere->lPrekoPete, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoPete', 'dPrekoPete', null, null, $mjere->dPrekoPete, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Stopalo</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Preko najistaknutije točke dorsuma
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPrekoDorsumaStopala', 'lPrekoDorsumaStopala', null, null, $mjere->lPrekoDorsumaStopala, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPrekoDorsumaStopala', 'dPrekoDorsumaStopala', null, null, $mjere->dPrekoDorsumaStopala, null, false) ?>
								</div>
							</div>
							<div class="row">
							<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Dinamometrija šake (kg)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSakaDinam', 'lSakaDinam', null, null, $mjere->lSakaDinam, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSakaDinam', 'dSakaDinam', null, null, $mjere->dSakaDinam, null, false) ?>
								</div>
							</div>
						</div>
					</li>
					<li class="accordion-navigation">
						<a href="#amplituda"  role="tab" id="amplituda-heading" aria-controls="amplituda">Amplitude pokreta</a>
						<div id="amplituda" class="content" role="tabpanel" aria-labelledby="amplituda-heading">
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Vrat</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Cervikalni fleš cm
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'CFlesh', 'CFlesh', null, null, $mjere->lCFlesh, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Indeks sagitalne gibljivosti
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'indSagGibC', 'indSagGibC', null, null, $mjere->lIndSagGibC, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija lateralis cm
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLatFleksC', 'lLatFleksC', null, null, $mjere->lLatFleksC, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLatFleksC', 'dLatFleksC', null, null, $mjere->dLatFleksC, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotacija
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRotacijaC', 'lRotacijaC', null, null, $mjere->lRotacijaC, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRotacijaC', 'dRotacijaC', null, null, $mjere->dRotacijaC, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Kralježnica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Indeks sagitalne gibljivosti Th
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'indSagGibT', 'indSagGibT', null, null, $mjere->lIndSagGibT, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Opseg disanja
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'ODisanja', 'ODisanja', null, null, $mjere->lODisanja, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Indeks sagitalne gibljivosti L
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'indSagGibL', 'indSagGibL', null, null, $mjere->lIndSagGibL, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Laterofleksija trupa
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLatFlexTrupa', 'lLatFlexTrupa', null, null, $mjere->lLatFlexTrupa, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLatFlexTrupa', 'dLatFlexTrupa', null, null, $mjere->dLatFlexTrupa, null, false) ?>
								</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Znak tetive na luku
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lZnakTetiveNaLuku', 'lZnakTetiveNaLuku', null, null, $mjere->lZnakTetiveNaLuku, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dZnakTetiveNaLuku', 'dZnakTetiveNaLuku', null, null, $mjere->dZnakTetiveNaLuku, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fenomen gumene lopte
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'fenomenGumeneLopte', 'fenomenGumeneLopte', null, null, $mjere->lFenomenGumeneLopte, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Rame</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abdukcija (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameAbd', 'lRameAbd', null, null, $mjere->lRameAbd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameAbd', 'dRameAbd', null, null, $mjere->dRameAbd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Elevacija (75°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameElev', 'lRameElev', null, null, $mjere->lRameElev, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameElev', 'dRameElev', null, null, $mjere->dRameElev, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Antefleksija (165°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameAnt', 'lRameAnt', null, null, $mjere->lRameAnt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameAnt', 'dRameAnt', null, null, $mjere->dRameAnt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Retrofleksija (75°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameRet', 'lRameRet', null, null, $mjere->lRameRet, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameRet', 'dRameRet', null, null, $mjere->dRameRet, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotacija unutarnja (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameURot', 'lRameURot', null, null, $mjere->lRameURot, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameURot', 'dRameURot', null, null, $mjere->dRameURot, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotacija vanjska (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameVRot', 'lRameVRot', null, null, $mjere->lRameVRot, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameVRot', 'dRameVRot', null, null, $mjere->dRameVRot, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Horizontalna abdukcija (45°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameHorAbd', 'lRameHorAbd', null, null, $mjere->lRameHorAbd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameHorAbd', 'dRameHorAbd', null, null, $mjere->dRameHorAbd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Horizontalna addukcija (135°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRameHorAdd', 'lRameHorAdd', null, null, $mjere->lRameHorAdd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRameHorAdd', 'dRameHorAdd', null, null, $mjere->dRameHorAdd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Lakat</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLakatExt', 'lLakatExt', null, null, $mjere->lLakatExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLakatExt', 'dLakatExt', null, null, $mjere->dLakatExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija (135°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLakatFlex', 'lLakatFlex', null, null, $mjere->lLakatFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLakatFlex', 'dLakatFlex', null, null, $mjere->dLakatFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Supinacija (80-90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSupinacija', 'lSupinacija', null, null, $mjere->lSupinacija, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSupinacija', 'dSupinacija', null, null, $mjere->dSupinacija, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Pronacija (80-90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPronacija', 'lPronacija', null, null, $mjere->lPronacija, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPronacija', 'dPronacija', null, null, $mjere->dPronacija, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Volarna fleksija (60-70°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lVolarFlex', 'lVolarFlex', null, null, $mjere->lVolarFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dVolarFlex', 'dVolarFlex', null, null, $mjere->dVolarFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Dorzalna fleksija (60°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lDorsalFlex', 'lDorsalFlex', null, null, $mjere->lDorsalFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dDorsalFlex', 'dDorsalFlex', null, null, $mjere->dDorsalFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abdukcija ulnaris (50°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAbdUln', 'lAbdUln', null, null, $mjere->lAbdUln, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAbdUln', 'dAbdUln', null, null, $mjere->dAbdUln, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abdukcija radialis (40°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAbdRad', 'lAbdRad', null, null, $mjere->lAbdRad, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAbdRad', 'dAbdRad', null, null, $mjere->dAbdRad, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Palac ruke</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abdukcija (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalacAbd', 'lRPalacAbd', null, null, $mjere->lRPalacAbd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalacAbd', 'dRPalacAbd', null, null, $mjere->dRPalacAbd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Addukcija (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalacAdd', 'lRPalacAdd', null, null, $mjere->lRPalacAdd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalacAdd', 'dRPalacAdd', null, null, $mjere->dRPalacAdd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija MCP zgloba (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalacFlex', 'lRPalacFlex', null, null, $mjere->lRPalacFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalacFlex', 'dRPalacFlex', null, null, $mjere->dRPalacFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija MCP zgloba (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalacExt', 'lRPalacExt', null, null, $mjere->lRPalacExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalacExt', 'dRPalacExt', null, null, $mjere->dRPalacExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija IF zgloba (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalac1ZglFlex', 'lRPalac1ZglFlex', null, null, $mjere->lRPalac1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalac1ZglFlex', 'dRPalac1ZglFlex', null, null, $mjere->dRPalac1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Opozicija
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRPalacOpozicija', 'lRPalacOpozicija', null, null, $mjere->lRPalacOpozicija, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRPalacOpozicija', 'dRPalacOpozicija', null, null, $mjere->dRPalacOpozicija, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst II</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija osnovnog zgloba MCP (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR2Pr1ZglExt', 'lR2Pr1ZglExt', null, null, $mjere->lR2Pr1ZglExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR2Pr1ZglExt', 'dR2Pr1ZglExt', null, null, $mjere->dR2Pr1ZglExt, null, false) ?>
								</div>
								
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija osnovnog zgloba MCP (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR2Pr1ZglFlex', 'lR2Pr1ZglFlex', null, null, $mjere->lR2Pr1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR2Pr1ZglFlex', 'dR2Pr1ZglFlex', null, null, $mjere->dR2Pr1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija srednjeg zgloba PIP (100°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR2Pr2ZglFlex', 'lR2Pr2ZglFlex', null, null, $mjere->lR2Pr2ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR2Pr2ZglFlex', 'dR2Pr2ZglFlex', null, null, $mjere->dR2Pr2ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija krajnjeg zgloba DIP (80°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR2Pr3ZglFlex', 'lR2Pr3ZglFlex', null, null, $mjere->lR2Pr3ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR2Pr3ZglFlex', 'dR2Pr3ZglFlex', null, null, $mjere->dR2Pr3ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst III</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija osnovnog zgloba MCP (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR3Pr1ZglExt', 'lR3Pr1ZglExt', null, null, $mjere->lR3Pr1ZglExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR3Pr1ZglExt', 'dR3Pr1ZglExt', null, null, $mjere->dR3Pr1ZglExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija osnovnog zgloba MCP (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR3Pr1ZglFlex', 'lR3Pr1ZglFlex', null, null, $mjere->lR3Pr1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR3Pr1ZglFlex', 'dR3Pr1ZglFlex', null, null, $mjere->dR3Pr1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija srednjeg zgloba PIP (100°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR3Pr2ZglFlex', 'lR3Pr2ZglFlex', null, null, $mjere->lR3Pr2ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR3Pr2ZglFlex', 'dR3Pr2ZglFlex', null, null, $mjere->dR3Pr2ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija krajnjeg zgloba DIP (80°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR3Pr3ZglFlex', 'lR3Pr3ZglFlex', null, null, $mjere->lR3Pr3ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR3Pr3ZglFlex', 'dR3Pr3ZglFlex', null, null, $mjere->dR3Pr3ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst IV</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija osnovnog zgloba MCP (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR4Pr1ZglExt', 'lR4Pr1ZglExt', null, null, $mjere->lR4Pr1ZglExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR4Pr1ZglExt', 'dR4Pr1ZglExt', null, null, $mjere->dR4Pr1ZglExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija osnovnog zgloba MCP (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR4Pr1ZglFlex', 'lR4Pr1ZglFlex', null, null, $mjere->lR4Pr1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR4Pr1ZglFlex', 'dR4Pr1ZglFlex', null, null, $mjere->dR4Pr1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija srednjeg zgloba PIP (100°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR4Pr2ZglFlex', 'lR4Pr2ZglFlex', null, null, $mjere->lR4Pr2ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR4Pr2ZglFlex', 'dR4Pr2ZglFlex', null, null, $mjere->dR4Pr2ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija krajnjeg zgloba DIP (80°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR4Pr3ZglFlex', 'lR4Pr3ZglFlex', null, null, $mjere->lR4Pr3ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR4Pr3ZglFlex', 'dR4Pr3ZglFlex', null, null, $mjere->dR4Pr3ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst V</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija osnovnog zgloba MCP (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR5Pr1ZglExt', 'lR5Pr1ZglExt', null, null, $mjere->lR5Pr1ZglExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR5Pr1ZglExt', 'dR5Pr1ZglExt', null, null, $mjere->dR5Pr1ZglExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija osnovnog zgloba MCP (90°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR5Pr1ZglFlex', 'lR5Pr1ZglFlex', null, null, $mjere->lR5Pr1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR5Pr1ZglFlex', 'dR5Pr1ZglFlex', null, null, $mjere->dR5Pr1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija srednjeg zgloba PIP (100°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR5Pr2ZglFlex', 'lR5Pr2ZglFlex', null, null, $mjere->lR5Pr2ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR5Pr2ZglFlex', 'dR5Pr2ZglFlex', null, null, $mjere->dR5Pr2ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija krajnjeg zgloba DIP (80°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lR5Pr3ZglFlex', 'lR5Pr3ZglFlex', null, null, $mjere->lR5Pr3ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dR5Pr3ZglFlex', 'dR5Pr3ZglFlex', null, null, $mjere->dR5Pr3ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Kuk</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija opruženim koljenom (80°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukFlexIsprKoljeno', 'lKukFlexIsprKoljeno', null, null, $mjere->lKukFlexIsprKoljeno, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukFlexIsprKoljeno', 'dKukFlexIsprKoljeno', null, null, $mjere->dKukFlexIsprKoljeno, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija savijenim koljenom (100°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukFlexSavKoljeno', 'lKukFlexSavKoljeno', null, null, $mjere->lKukFlexSavKoljeno, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukFlexSavKoljeno', 'dKukFlexSavKoljeno', null, null, $mjere->dKukFlexSavKoljeno, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija (20°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukExt', 'lKukExt', null, null, $mjere->lKukExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukExt', 'dKukExt', null, null, $mjere->dKukExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abdukcija (50°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukAbd', 'lKukAbd', null, null, $mjere->lKukAbd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukAbd', 'dKukAbd', null, null, $mjere->dKukAbd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Addukcija (30°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukAdd', 'lKukAdd', null, null, $mjere->lKukAdd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukAdd', 'dKukAdd', null, null, $mjere->dKukAdd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotacija unutarnja (50°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukUnRot', 'lKukUnRot', null, null, $mjere->lKukUnRot, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukUnRot', 'dKukUnRot', null, null, $mjere->dKukUnRot, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotacija vanjska (40°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKukVanRot', 'lKukVanRot', null, null, $mjere->lKukVanRot, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKukVanRot', 'dKukVanRot', null, null, $mjere->dKukVanRot, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Koljeno</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija (135°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKoljFlex', 'lKoljFlex', null, null, $mjere->lKoljFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKoljFlex', 'dKoljFlex', null, null, $mjere->dKoljFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lKoljExt', 'lKoljExt', null, null, $mjere->lKoljExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dKoljExt', 'dKoljExt', null, null, $mjere->dKoljExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Skočni zglob</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Dorzalna fleksija (25°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSkZglDorFlex', 'lSkZglDorFlex', null, null, $mjere->lSkZglDorFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSkZglDorFlex', 'dSkZglDorFlex', null, null, $mjere->dSkZglDorFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Plantarna fleksija (40°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSkZglPlanFlex', 'lSkZglPlanFlex', null, null, $mjere->lSkZglPlanFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSkZglPlanFlex', 'dSkZglPlanFlex', null, null, $mjere->dSkZglPlanFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Everzija (30°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSkZglEver', 'lSkZglEver', null, null, $mjere->lSkZglEver, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSkZglEver', 'dSkZglEver', null, null, $mjere->dSkZglEver, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Inverzija (40°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSkZglInv', 'lSkZglInv', null, null, $mjere->lSkZglInv, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSkZglInv', 'dSkZglInv', null, null, $mjere->dSkZglInv, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Palac noge</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ekstenzija osnovnog zgloba (0°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lNPalac1ZglExt', 'lNPalac1ZglExt', null, null, $mjere->lNPalac1ZglExt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dNPalac1ZglExt', 'dNPalac1ZglExt', null, null, $mjere->dNPalac1ZglExt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija osnovnog zgloba (40°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lNPalac1ZglFlex', 'lNPalac1ZglFlex', null, null, $mjere->lNPalac1ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dNPalac1ZglFlex', 'dNPalac1ZglFlex', null, null, $mjere->dNPalac1ZglFlex, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Fleksija krajnjeg zgloba (45°)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lNPalac2ZglFlex', 'lNPalac2ZglFlex', null, null, $mjere->lNPalac2ZglFlex, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dNPalac2ZglFlex', 'dNPalac2ZglFlex', null, null, $mjere->dNPalac2ZglFlex, null, false) ?>
								</div>
							</div>
						</div>
					</li>
					<li class="accordion-navigation">
						<a href="#mmt" role="tab" id="mmt-heading" aria-controls="mmt">MMT</a>
						<div id="mmt" class="content" role="tabpanel" aria-labelledby="mmt-heading">
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Lice</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Orbicularis oris
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lOrbOr', 'lOrbOr', null, null, $mjere->lOrbOr, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dOrbOr', 'dOrbOr', null, null, $mjere->dOrbOr, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Orbicularis oculi
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lOrbOc', 'lOrbOc', null, null, $mjere->lOrbOc, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dOrbOc', 'dOrbOc', null, null, $mjere->dOrbOc, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Zygomaticus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lZyg', 'lZyg', null, null, $mjere->lZyg, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dZyg', 'dZyg', null, null, $mjere->dZyg, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Frontalis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFront', 'lFront', null, null, $mjere->lFront, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFront', 'dFront', null, null, $mjere->dFront, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Vrat</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexores capitis et colli
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'flexCapitEtColi', 'flexCapitEtColi', null, null, $mjere->lFlexCapitEtColi, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensores capitits et colli
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'extCapitEtColi', 'extCapitEtColi', null, null, $mjere->lExtCapitEtColi, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Trup</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rectus abdominis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'rectusAbdom', 'rectusAbdom', null, null, $mjere->lRectusAbdom, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensore trunci
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'extTrunci', 'extTrunci', null, null, $mjere->lExtTrunci, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'none', 'none', null, null, null, array('readonly'=>true), false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Obliqui abdominis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lObliquiAbd', 'lObliquiAbd', null, null, $mjere->lObliquiAbd, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dObliquiAbd', 'dObliquiAbd', null, null, $mjere->dObliquiAbd, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexsores lateralis trunci
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexLatTrunci', 'lFlexLatTrunci', null, null, $mjere->lFlexLatTrunci, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexLatTrunci', 'dFlexLatTrunci', null, null, $mjere->dFlexLatTrunci, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Lopatica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Serratus anterior
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSerrAnt', 'lSerrAnt', null, null, $mjere->lSerrAnt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSerrAnt', 'dSerrAnt', null, null, $mjere->dSerrAnt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Trapezius descendes (elevacija)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTrapDesc', 'lTrapDesc', null, null, $mjere->lTrapDesc, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTrapDesc', 'dTrapDesc', null, null, $mjere->dTrapDesc, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Trapezius ascendes (depresija)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTrapAsc', 'lTrapAsc', null, null, $mjere->lTrapAsc, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTrapAsc', 'dTrapAsc', null, null, $mjere->dTrapAsc, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rhomboidei
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRhomb', 'lRhomb', null, null, $mjere->lRhomb, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRhomb', 'dRhomb', null, null, $mjere->dRhomb, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Nadlaktica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Deltoideus - clavicularis, coracobrachialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lDeltClav', 'lDeltClav', null, null, $mjere->lDeltClav, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dDeltClav', 'dDeltClav', null, null, $mjere->dDeltClav, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Deltoideus - acromialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lDeltAcr', 'lDeltAcr', null, null, $mjere->lDeltAcr, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dDeltAcr', 'dDeltAcr', null, null, $mjere->dDeltAcr, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Deltoideus - spinalis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lDeltSpin', 'lDeltSpin', null, null, $mjere->lDeltSpin, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dDeltSpin', 'dDeltSpin', null, null, $mjere->dDeltSpin, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Latissimus dorsi
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLattDor', 'lLattDor', null, null, $mjere->lLattDor, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLattDor', 'dLattDor', null, null, $mjere->dLattDor, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Pectoralis major
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPectMaj', 'lPectMaj', null, null, $mjere->lPectMaj, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPectMaj', 'dPectMaj', null, null, $mjere->dPectMaj, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotatores externi
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRotExtBra', 'lRotExtBra', null, null, $mjere->lRotExtBra, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRotExtBra', 'dRotExtBra', null, null, $mjere->dRotExtBra, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotatores interni
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRotIntBra', 'lRotIntBra', null, null, $mjere->lRotIntBra, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRotIntBra', 'dRotIntBra', null, null, $mjere->dRotIntBra, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Biceps brachii
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lBicBra', 'lBicBra', null, null, $mjere->lBicBra, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dBicBra', 'dBicBra', null, null, $mjere->dBicBra, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Brachialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lBrachialis', 'lBrachialis', null, null, $mjere->lBrachialis, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dBrachialis', 'dBrachialis', null, null, $mjere->dBrachialis, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Brachioradialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lBrachioradialis', 'lBrachioradialis', null, null, $mjere->lBrachioradialis, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dBrachioradialis', 'dBrachioradialis', null, null, $mjere->dBrachioradialis, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Triceps brachii
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTriBra', 'lTriBra', null, null, $mjere->lTriBra, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTriBra', 'dTriBra', null, null, $mjere->dTriBra, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Supinator, biceps brachii
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSupinator', 'lSupinator', null, null, $mjere->lSupinator, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSupinator', 'dSupinator', null, null, $mjere->dSupinator, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Pronator teres et quadratus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPron', 'lPron', null, null, $mjere->lPron, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPron', 'dPron', null, null, $mjere->dPron, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor carpi radialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexCarpRad', 'lFlexCarpRad', null, null, $mjere->lFlexCarpRad, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexCarpRad', 'dFlexCarpRad', null, null, $mjere->dFlexCarpRad, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor carpi ulnaris
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexCarpUln', 'lFlexCarpUln', null, null, $mjere->lFlexCarpUln, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexCarpUln', 'dFlexCarpUln', null, null, $mjere->dFlexCarpUln, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor carpi radialis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtCarpRad', 'lExtCarpRad', null, null, $mjere->lExtCarpRad, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtCarpRad', 'dExtCarpRad', null, null, $mjere->dExtCarpRad, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor carpi ulnaris
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtCarpUln', 'lExtCarpUln', null, null, $mjere->lExtCarpUln, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtCarpUln', 'dExtCarpUln', null, null, $mjere->dExtCarpUln, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Prsti ruke</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Lubricales et interossei
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLumbEtInterossei', 'lLumbEtInterossei', null, null, $mjere->lLumbEtInterossei, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLumbEtInterossei', 'dLumbEtInterossei', null, null, $mjere->dLumbEtInterossei, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor digitorum communis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtDigComCarp', 'lExtDigComCarp', null, null, $mjere->lExtDigComCarp, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtDigComCarp', 'dExtDigComCarp', null, null, $mjere->dExtDigComCarp, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor digitorum sublimis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexDigSubl', 'lFlexDigSubl', null, null, $mjere->lFlexDigSubl, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexDigSubl', 'dFlexDigSubl', null, null, $mjere->dFlexDigSubl, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor digitorum profundus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexDigProf', 'lFlexDigProf', null, null, $mjere->lFlexDigProf, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexDigProf', 'dFlexDigProf', null, null, $mjere->dFlexDigProf, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Adductores digitorum
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAddDig', 'lAddDig', null, null, $mjere->lAddDig, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAddDig', 'dAddDig', null, null, $mjere->dAddDig, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abductores digitorum
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAbdDig', 'lAbdDig', null, null, $mjere->lAbdDig, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAbdDig', 'dAbdDig', null, null, $mjere->dAbdDig, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Palčevi</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Abductores pollicis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAbdPol', 'lAbdPol', null, null, $mjere->lAbdPol, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAbdPol', 'dAbdPol', null, null, $mjere->dAbdPol, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Adductor pollicis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAddPol', 'lAddPol', null, null, $mjere->lAddPol, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAddPol', 'dAddPol', null, null, $mjere->dAddPol, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Opponens pollicis et dg. minimi
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lOppon', 'lOppon', null, null, $mjere->lOppon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dOppon', 'dOppon', null, null, $mjere->dOppon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor pollicis brevis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexPolBre', 'lFlexPolBre', null, null, $mjere->lFlexPolBre, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexPolBre', 'dFlexPolBre', null, null, $mjere->dFlexPolBre, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor pollicis longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexPolLon', 'lFlexPolLon', null, null, $mjere->lFlexPolLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexPolLon', 'dFlexPolLon', null, null, $mjere->dFlexPolLon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor pollicis brevis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtPolBre', 'lExtPolBre', null, null, $mjere->lExtPolBre, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtPolBre', 'dExtPolBre', null, null, $mjere->dExtPolBre, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor pollicis longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtPolLon', 'lExtPolLon', null, null, $mjere->lExtPolLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtPolLon', 'dExtPolLon', null, null, $mjere->dExtPolLon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Bedro</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Ilioopsoas
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lIliopsoas', 'lIliopsoas', null, null, $mjere->lIliopsoas, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dIliopsoas', 'dIliopsoas', null, null, $mjere->dIliopsoas, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Gluteus maximus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lGlutMax', 'lGlutMax', null, null, $mjere->lGlutMax, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dGlutMax', 'dGlutMax', null, null, $mjere->dGlutMax, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Adductores
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lAddCoxae', 'lAddCoxae', null, null, $mjere->lAddCoxae, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dAddCoxae', 'dAddCoxae', null, null, $mjere->dAddCoxae, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Gluteus medius (abdukcija)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lGlutMed', 'lGlutMed', null, null, $mjere->lGlutMed, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dGlutMed', 'dGlutMed', null, null, $mjere->dGlutMed, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotatores interni
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRotIntCoxae', 'lRotIntCoxae', null, null, $mjere->lRotIntCoxae, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRotIntCoxae', 'dRotIntCoxae', null, null, $mjere->dRotIntCoxae, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Tensor fasciae latae
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTenFasLat', 'lTenFasLat', null, null, $mjere->lTenFasLat, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTenFasLat', 'dTenFasLat', null, null, $mjere->dTenFasLat, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Rotatores externi
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lRotExtCoxae', 'lRotExtCoxae', null, null, $mjere->lRotExtCoxae, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dRotExtCoxae', 'dRotExtCoxae', null, null, $mjere->dRotExtCoxae, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Sartorius
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSartorius', 'lSartorius', null, null, $mjere->lSartorius, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSartorius', 'dSartorius', null, null, $mjere->dSartorius, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Potkoljenica</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Biceps femoris
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lBicFem', 'lBicFem', null, null, $mjere->lBicFem, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dBicFem', 'dBicFem', null, null, $mjere->dBicFem, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Semitendinosus et semimembranosus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSemEtSem', 'lSemEtSem', null, null, $mjere->lSemEtSem, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSemEtSem', 'dSemEtSem', null, null, $mjere->dSemEtSem, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensori (Quadriceps femoris)
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lQuadFem', 'lQuadFem', null, null, $mjere->lQuadFem, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dQuadFem', 'dQuadFem', null, null, $mjere->dQuadFem, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Stopalo</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Gastrocnemius
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lGastroc', 'lGastroc', null, null, $mjere->lGastroc, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dGastroc', 'dGastroc', null, null, $mjere->dGastroc, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Soleus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lSoleus', 'lSoleus', null, null, $mjere->lSoleus, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dSoleus', 'dSoleus', null, null, $mjere->dSoleus, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Tibialis anterior
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTibAnt', 'lTibAnt', null, null, $mjere->lTibAnt, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTibAnt', 'dTibAnt', null, null, $mjere->dTibAnt, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Tibialis posterior
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lTibPost', 'lTibPost', null, null, $mjere->lTibPost, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dTibPost', 'dTibPost', null, null, $mjere->dTibPost, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Peronaei
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lPer', 'lPer', null, null, $mjere->lPer, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dPer', 'dPer', null, null, $mjere->dPer, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-12 medium-12 small-12 columns center mt15"><b>Prsti stopala</b></div>
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Lumbricales et interossei
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lLumbEtInterPed', 'lLumbEtInterPed', null, null, $mjere->lLumbEtInterPed, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dLumbEtInterPed', 'dLumbEtInterPed', null, null, $mjere->dLumbEtInterPed, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor digitorum brevis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexDigBre', 'lFlexDigBre', null, null, $mjere->lFlexDigBre, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexDigBre', 'dFlexDigBre', null, null, $mjere->dFlexDigBre, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor digitorum longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexDigLon', 'lFlexDigLon', null, null, $mjere->lFlexDigLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexDigLon', 'dFlexDigLon', null, null, $mjere->dFlexDigLon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor digitorum longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtDigLon', 'lExtDigLon', null, null, $mjere->lExtDigLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtDigLon', 'dExtDigLon', null, null, $mjere->dExtDigLon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor digitorum communis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtDigCom', 'lExtDigCom', null, null, $mjere->lExtDigCom, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtDigCom', 'dExtDigCom', null, null, $mjere->dExtDigCom, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor hallucis longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexHalLon', 'lFlexHalLon', null, null, $mjere->lFlexHalLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexHalLon', 'dFlexHalLon', null, null, $mjere->dFlexHalLon, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Flexor hallucis brevis
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lFlexHalBre', 'lFlexHalBre', null, null, $mjere->lFlexHalBre, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dFlexHalBre', 'dFlexHalBre', null, null, $mjere->dFlexHalBre, null, false) ?>
								</div>
							</div>
							<div class="row">
								<div class="large-6 large-push-3 medium-12 small-12 columns center">
									Extensor hallucis longus
								</div>
								<div class="large-3 large-pull-6 medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'lExtHalLon', 'lExtHalLon', null, null, $mjere->lExtHalLon, null, false) ?>
								</div>						
								<div class="large-3 large-reset-order medium-6 small-6 columns">
									<?= Html::Input(null, 'text', 'dExtHalLon', 'dExtHalLon', null, null, $mjere->dExtHalLon, null, false) ?>
								</div>
							</div>
						</div>
					</li>
					<li class="accordion-navigation">
						<a href="#ostaleMjere" role="tab" id="ostaleMjere-heading" aria-controls="ostaleMjere">Ostalo</a>
						<div id="ostaleMjere" class="content" role="tabpanel" aria-labelledby="ostaleMjere-heading">
							<div class="row">
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Ne hoda od', 'text', 'neHoda', 'neHoda', null, null, $mjere->neHoda) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Hoda sa štakama od', 'text', 'hodSaStakama', 'hodSaStakama', null, null, $mjere->hodSaStakama) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Stoji od', 'text', 'stoji', 'stoji', null, null, $mjere->stoji) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Hoda sa štapovima od', 'text', 'hodSaStapovima', 'hodSaStapovima', null, null, $mjere->hodSaStapovima) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Hoda sa aparatima od', 'text', 'hodSaAparatima', 'hodSaAparatima', null, null, $mjere->hodSaAparatima) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Hoda samostalno od', 'text', 'hodSamostalno', 'hodSamostalno', null, null, $mjere->hodSamostalno) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Hoda sa korzetom od', 'text', 'hodSaKorzetom', 'hodSaKorzetom', null, null, $mjere->hodSaKorzetom) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Ide stepenicama od', 'text', 'ideStepenicama', 'ideStepenicama', null, null, $mjere->ideStepenicama) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Pomoćni aparati', 'text', 'pomocniAparati', 'pomocniAparati', null, null, $mjere->pomocniAparati) ?>
								</div>
								<div class="large-6 medium-6 small-12 columns">
									<?= Html::Input('Scoliosis i deformiteti', 'text', 'scoliosis', 'scoliosis', null, null, $mjere->scoliosis) ?>
								</div>
							</div>					
						</div>
					</li>	
				</ul>
			</fieldset>
			<div class="row mb40 mt40">
				<div class="large-6 columns">
					<?= Html::Submit('Spremi promjene', array('siroko', 'success', 'spremi', 'round', 'button')) ?>
				</div>
				<div class="large-6 columns">
					<?= Html::Button('Obriši mjere', array('siroko', 'alert', 'spremi', 'obrisiMjere','round', 'button')) ?>
				</div>
			</div>	
		</form>		
	</div>
	<?php } ?>	
</div>

<?php
include_once '../masters/masterBottom.php';
?>

