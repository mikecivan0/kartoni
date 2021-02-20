<div class="large-12 columns">
	
	<?= $mjere->ispisMjera() ?>
	
	<fieldset class="mt40">
		<legend>
			Unos novih mjera
		</legend>

		<div class="row">
			<div class="large-3 medium-12 small-12 columns mb40">
				<?= Html::Input('Datum mjerenja', 'date', 'datumMjerenja', 'datumMjerenja') ?>
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
							<?= Html::Input(null, 'text', 'lPolazisteDeltoideusa', 'lPolazisteDeltoideusa', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPolazisteDeltoideusa', 'dPolazisteDeltoideusa', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Na hvatištu m. deltoideusa
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lHvatisteDeltoideusa', 'lHvatisteDeltoideusa', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dHvatisteDeltoideusa', 'dHvatisteDeltoideusa', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Po sredini nadlaktice
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSredinaNadlaktice', 'lSredinaNadlaktice', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSredinaNadlaktice', 'dSredinaNadlaktice', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Lakat</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko olekranona
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoOlekranona', 'lPrekoOlekranona', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoOlekranona', 'dPrekoOlekranona', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Po sredini podlaktice
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoSredinePodlaktice', 'lPrekoSredinePodlaktice', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoSredinePodlaktice', 'dPrekoSredinePodlaktice', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko ručnog zgloba
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoRucnogZgloba', 'lPrekoRucnogZgloba', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoRucnogZgloba', 'dPrekoRucnogZgloba', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko MCP zgloba
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoMetacarpusa', 'lPrekoMetacarpusa', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoMetacarpusa', 'dPrekoMetacarpusa', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Opseg prsta
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lOPrsta', 'lOPrsta', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dOPrsta', 'dOPrsta', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Natkoljenica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							15 cm iznad gornjeg ruba patele
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'l15IznadPatele', 'l15IznadPatele', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'd15IznadPatele', 'd15IznadPatele', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Koljeno</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko sredine patele
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoPatele', 'lPrekoPatele', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoPatele', 'dPrekoPatele', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Potkoljenica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							15 cm ispod donjeg ruba patele
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'l15IspodPatele', 'l15IspodPatele', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'd15IspodPatele', 'd15IspodPatele', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Skočni zglob</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko maleola
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoMaleola', 'lPrekoMaleola', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoMaleola', 'dPrekoMaleola', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko pete pod kutom od 45°
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoPete', 'lPrekoPete', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoPete', 'dPrekoPete', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Stopalo</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Preko najistaknutije točke dorsuma
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPrekoDorsumaStopala', 'lPrekoDorsumaStopala', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPrekoDorsumaStopala', 'dPrekoDorsumaStopala', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
					<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Dinamometrija šake (kg)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSakaDinam', 'lSakaDinam', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSakaDinam', 'dSakaDinam', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'CFlesh', 'CFlesh', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'indSagGibC', 'indSagGibC', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'lLatFleksC', 'lLatFleksC', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLatFleksC', 'dLatFleksC', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
					<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotacija
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRotacijaC', 'lRotacijaC', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRotacijaC', 'dRotacijaC', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Kralježnica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Indeks sagitalne gibljivosti Th
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'indSagGibT', 'indSagGibT', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'ODisanja', 'ODisanja', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'indSagGibL', 'indSagGibL', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'lLatFlexTrupa', 'lLatFlexTrupa', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLatFlexTrupa', 'dLatFlexTrupa', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Znak tetive na luku
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lZnakTetiveNaLuku', 'lZnakTetiveNaLuku', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dZnakTetiveNaLuku', 'dZnakTetiveNaLuku', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fenomen gumene lopte
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'fenomenGumeneLopte', 'fenomenGumeneLopte', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'lRameAbd', 'lRameAbd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameAbd', 'dRameAbd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Elevacija (75°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameElev', 'lRameElev', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameElev', 'dRameElev', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Antefleksija (165°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameAnt', 'lRameAnt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameAnt', 'dRameAnt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Retrofleksija (75°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameRet', 'lRameRet', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameRet', 'dRameRet', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotacija unutarnja (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameURot', 'lRameURot', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameURot', 'dRameURot', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotacija vanjska (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameVRot', 'lRameVRot', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameVRot', 'dRameVRot', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Horizontalna abdukcija (45°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameHorAbd', 'lRameHorAbd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameHorAbd', 'dRameHorAbd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Horizontalna addukcija (135°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRameHorAdd', 'lRameHorAdd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRameHorAdd', 'dRameHorAdd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Lakat</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lLakatExt', 'lLakatExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLakatExt', 'dLakatExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija (135°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lLakatFlex', 'lLakatFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLakatFlex', 'dLakatFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Supinacija (80-90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSupinacija', 'lSupinacija', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSupinacija', 'dSupinacija', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Pronacija (80-90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPronacija', 'lPronacija', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPronacija', 'dPronacija', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Volarna fleksija (60-70°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lVolarFlex', 'lVolarFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dVolarFlex', 'dVolarFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Dorzalna fleksija (60°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lDorsalFlex', 'lDorsalFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dDorsalFlex', 'dDorsalFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abdukcija ulnaris (50°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAbdUln', 'lAbdUln', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAbdUln', 'dAbdUln', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abdukcija radialis (40°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAbdRad', 'lAbdRad', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAbdRad', 'dAbdRad', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Palac ruke</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abdukcija (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalacAbd', 'lRPalacAbd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalacAbd', 'dRPalacAbd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Addukcija (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalacAdd', 'lRPalacAdd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalacAdd', 'dRPalacAdd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija MCP zgloba (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalacFlex', 'lRPalacFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalacFlex', 'dRPalacFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija MCP zgloba (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalacExt', 'lRPalacExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalacExt', 'dRPalacExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija IF zgloba (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalac1ZglFlex', 'lRPalac1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalac1ZglFlex', 'dRPalac1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Opozicija (cm između vrhova I. i V. prsta)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRPalacOpozicija', 'lRPalacOpozicija', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRPalacOpozicija', 'dRPalacOpozicija', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst II</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija osnovnog zgloba MCP (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR2Pr1ZglExt', 'lR2Pr1ZglExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR2Pr1ZglExt', 'dR2Pr1ZglExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija osnovnog zgloba MCP (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR2Pr1ZglFlex', 'lR2Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR2Pr1ZglFlex', 'dR2Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija srednjeg zgloba PIP (100°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR2Pr2ZglFlex', 'lR2Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR2Pr2ZglFlex', 'dR2Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija krajnjeg zgloba DIP (80°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR2Pr3ZglFlex', 'lR2Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR2Pr3ZglFlex', 'dR2Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst III</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija osnovnog zgloba MCP (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR3Pr1ZglExt', 'lR3Pr1ZglExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR3Pr1ZglExt', 'dR3Pr1ZglExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija osnovnog zgloba MCP (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR3Pr1ZglFlex', 'lR3Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR3Pr1ZglFlex', 'dR3Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija srednjeg zgloba PIP (100°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR3Pr2ZglFlex', 'lR3Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR3Pr2ZglFlex', 'dR3Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija krajnjeg zgloba DIP (80°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR3Pr3ZglFlex', 'lR3Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR3Pr3ZglFlex', 'dR3Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst IV</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija osnovnog zgloba MCP (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR4Pr1ZglExt', 'lR4Pr1ZglExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR4Pr1ZglExt', 'dR4Pr1ZglExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija osnovnog zgloba MCP (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR4Pr1ZglFlex', 'lR4Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR4Pr1ZglFlex', 'dR4Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija srednjeg zgloba PIP (100°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR4Pr2ZglFlex', 'lR4Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR4Pr2ZglFlex', 'dR4Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija krajnjeg zgloba DIP (80°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR4Pr3ZglFlex', 'lR4Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR4Pr3ZglFlex', 'dR4Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka prst V</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija osnovnog zgloba MCP (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR5Pr1ZglExt', 'lR5Pr1ZglExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR5Pr1ZglExt', 'dR5Pr1ZglExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija osnovnog zgloba MCP (90°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR5Pr1ZglFlex', 'lR5Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR5Pr1ZglFlex', 'dR5Pr1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija srednjeg zgloba PIP (100°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR5Pr2ZglFlex', 'lR5Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR5Pr2ZglFlex', 'dR5Pr2ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija krajnjeg zgloba DIP (80°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lR5Pr3ZglFlex', 'lR5Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dR5Pr3ZglFlex', 'dR5Pr3ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Kuk</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija opruženim koljenom (80°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukFlexIsprKoljeno', 'lKukFlexIsprKoljeno', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukFlexIsprKoljeno', 'dKukFlexIsprKoljeno', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija savijenim koljenom (100°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukFlexSavKoljeno', 'lKukFlexSavKoljeno', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukFlexSavKoljeno', 'dKukFlexSavKoljeno', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija (20°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukExt', 'lKukExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukExt', 'dKukExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abdukcija (50°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukAbd', 'lKukAbd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukAbd', 'dKukAbd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Addukcija (30°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukAdd', 'lKukAdd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukAdd', 'dKukAdd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotacija unutarnja (50°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukUnRot', 'lKukUnRot', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukUnRot', 'dKukUnRot', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotacija vanjska (40°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKukVanRot', 'lKukVanRot', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKukVanRot', 'dKukVanRot', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Koljeno</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija (135°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKoljFlex', 'lKoljFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKoljFlex', 'dKoljFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lKoljExt', 'lKoljExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dKoljExt', 'dKoljExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Skočni zglob</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Dorzalna fleksija (25°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSkZglDorFlex', 'lSkZglDorFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSkZglDorFlex', 'dSkZglDorFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Plantarna fleksija (40°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSkZglPlanFlex', 'lSkZglPlanFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSkZglPlanFlex', 'dSkZglPlanFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Everzija (30°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSkZglEver', 'lSkZglEver', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSkZglEver', 'dSkZglEver', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Inverzija (40°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSkZglInv', 'lSkZglInv', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSkZglInv', 'dSkZglInv', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Palac noge</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ekstenzija osnovnog zgloba (0°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lNPalac1ZglExt', 'lNPalac1ZglExt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dNPalac1ZglExt', 'dNPalac1ZglExt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija osnovnog zgloba (40°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lNPalac1ZglFlex', 'lNPalac1ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dNPalac1ZglFlex', 'dNPalac1ZglFlex', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Fleksija krajnjeg zgloba (45°)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lNPalac2ZglFlex', 'lNPalac2ZglFlex', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dNPalac2ZglFlex', 'dNPalac2ZglFlex', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'lOrbOr', 'lOrbOr', null, null, null, null, false) ?>
						</div>						
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dOrbOr', 'dOrbOr', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Orbicularis oculi
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lOrbOc', 'lOrbOc', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dOrbOc', 'dOrbOc', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Zygomaticus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lZyg', 'lZyg', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dZyg', 'dZyg', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Frontalis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFront', 'lFront', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFront', 'dFront', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Vrat</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexores capitis et colli
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'flexCapitEtColi', 'flexCapitEtColi', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'extCapitEtColi', 'extCapitEtColi', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'rectusAbdom', 'rectusAbdom', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'extTrunci', 'extTrunci', null, null, null, null, false) ?>
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
							<?= Html::Input(null, 'text', 'lObliquiAbd', 'lObliquiAbd', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dObliquiAbd', 'dObliquiAbd', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexsores lateralis trunci
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexLatTrunci', 'lFlexLatTrunci', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexLatTrunci', 'dFlexLatTrunci', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Lopatica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Serratus anterior
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSerrAnt', 'lSerrAnt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSerrAnt', 'dSerrAnt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Trapezius descendes (elevacija)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTrapDesc', 'lTrapDesc', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTrapDesc', 'dTrapDesc', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Trapezius ascendes (depresija)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTrapAsc', 'lTrapAsc', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTrapAsc', 'dTrapAsc', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rhomboidei
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRhomb', 'lRhomb', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRhomb', 'dRhomb', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Nadlaktica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Deltoideus - clavicularis, coracobrachialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lDeltClav', 'lDeltClav', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dDeltClav', 'dDeltClav', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Deltoideus - acromialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lDeltAcr', 'lDeltAcr', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dDeltAcr', 'dDeltAcr', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Deltoideus - spinalis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lDeltSpin', 'lDeltSpin', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dDeltSpin', 'dDeltSpin', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Latissimus dorsi
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lLattDor', 'lLattDor', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLattDor', 'dLattDor', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Pectoralis major
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPectMaj', 'lPectMaj', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPectMaj', 'dPectMaj', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotatores externi
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRotExtBra', 'lRotExtBra', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRotExtBra', 'dRotExtBra', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotatores interni
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRotIntBra', 'lRotIntBra', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRotIntBra', 'dRotIntBra', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Podlaktica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Biceps brachii
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lBicBra', 'lBicBra', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dBicBra', 'dBicBra', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Brachialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lBrachialis', 'lBrachialis', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dBrachialis', 'dBrachialis', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Brachioradialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lBrachioradialis', 'lBrachioradialis', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dBrachioradialis', 'dBrachioradialis', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Triceps brachii
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTriBra', 'lTriBra', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTriBra', 'dTriBra', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Supinator, biceps brachii
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSupinator', 'lSupinator', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSupinator', 'dSupinator', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Pronator teres et quadratus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPron', 'lPron', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPron', 'dPron', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Šaka</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor carpi radialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexCarpRad', 'lFlexCarpRad', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexCarpRad', 'dFlexCarpRad', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor carpi ulnaris
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexCarpUln', 'lFlexCarpUln', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexCarpUln', 'dFlexCarpUln', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor carpi radialis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtCarpRad', 'lExtCarpRad', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtCarpRad', 'dExtCarpRad', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor carpi ulnaris
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtCarpUln', 'lExtCarpUln', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtCarpUln', 'dExtCarpUln', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Prsti ruke</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Lubricales et interossei
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lLumbEtInterossei', 'lLumbEtInterossei', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLumbEtInterossei', 'dLumbEtInterossei', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor digitorum communis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtDigComCarp', 'lExtDigComCarp', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtDigComCarp', 'dExtDigComCarp', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor digitorum sublimis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexDigSubl', 'lFlexDigSubl', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexDigSubl', 'dFlexDigSubl', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor digitorum profundus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexDigProf', 'lFlexDigProf', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexDigProf', 'dFlexDigProf', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Adductores digitorum
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAddDig', 'lAddDig', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAddDig', 'dAddDig', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abductores digitorum
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAbdDig', 'lAbdDig', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAbdDig', 'dAbdDig', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Palčevi</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Abductores pollicis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAbdPol', 'lAbdPol', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAbdPol', 'dAbdPol', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Adductor pollicis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAddPol', 'lAddPol', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAddPol', 'dAddPol', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Opponens pollicis et dg. minimi
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lOppon', 'lOppon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dOppon', 'dOppon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor pollicis brevis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexPolBre', 'lFlexPolBre', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexPolBre', 'dFlexPolBre', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor pollicis longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexPolLon', 'lFlexPolLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexPolLon', 'dFlexPolLon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor pollicis brevis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtPolBre', 'lExtPolBre', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtPolBre', 'dExtPolBre', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor pollicis longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtPolLon', 'lExtPolLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtPolLon', 'dExtPolLon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Bedro</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Ilioopsoas
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lIliopsoas', 'lIliopsoas', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dIliopsoas', 'dIliopsoas', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Gluteus maximus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lGlutMax', 'lGlutMax', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dGlutMax', 'dGlutMax', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Adductores
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lAddCoxae', 'lAddCoxae', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dAddCoxae', 'dAddCoxae', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Gluteus medius (abdukcija)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lGlutMed', 'lGlutMed', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dGlutMed', 'dGlutMed', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotatores interni
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRotIntCoxae', 'lRotIntCoxae', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRotIntCoxae', 'dRotIntCoxae', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Tensor fasciae latae
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTenFasLat', 'lTenFasLat', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTenFasLat', 'dTenFasLat', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Rotatores externi
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lRotExtCoxae', 'lRotExtCoxae', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dRotExtCoxae', 'dRotExtCoxae', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Sartorius
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSartorius', 'lSartorius', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSartorius', 'dSartorius', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Potkoljenica</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Biceps femoris
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lBicFem', 'lBicFem', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dBicFem', 'dBicFem', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Semitendinosus et semimembranosus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSemEtSem', 'lSemEtSem', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSemEtSem', 'dSemEtSem', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensori (Quadriceps femoris)
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lQuadFem', 'lQuadFem', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dQuadFem', 'dQuadFem', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Stopalo</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Gastrocnemius
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lGastroc', 'lGastroc', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dGastroc', 'dGastroc', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Soleus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lSoleus', 'lSoleus', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dSoleus', 'dSoleus', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Tibialis anterior
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTibAnt', 'lTibAnt', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTibAnt', 'dTibAnt', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Tibialis posterior
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lTibPost', 'lTibPost', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dTibPost', 'dTibPost', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Peronaei
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lPer', 'lPer', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dPer', 'dPer', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-12 medium-12 small-12 columns center mt15"><b>Prsti stopala</b></div>
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Lumbricales et interossei
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lLumbEtInterPed', 'lLumbEtInterPed', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dLumbEtInterPed', 'dLumbEtInterPed', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor digitorum brevis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexDigBre', 'lFlexDigBre', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexDigBre', 'dFlexDigBre', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor digitorum longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexDigLon', 'lFlexDigLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexDigLon', 'dFlexDigLon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor digitorum longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtDigLon', 'lExtDigLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtDigLon', 'dExtDigLon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor digitorum communis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtDigCom', 'lExtDigCom', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtDigCom', 'dExtDigCom', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor hallucis longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexHalLon', 'lFlexHalLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexHalLon', 'dFlexHalLon', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Flexor hallucis brevis
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lFlexHalBre', 'lFlexHalBre', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dFlexHalBre', 'dFlexHalBre', null, null, null, null, false) ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 large-push-3 medium-12 small-12 columns center">
							Extensor hallucis longus
						</div>
						<div class="large-3 large-pull-6 medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'lExtHalLon', 'lExtHalLon', null, null, null, null, false) ?>
						</div>
						<div class="large-3 large-reset-order medium-6 small-6 columns">
							<?= Html::Input(null, 'text', 'dExtHalLon', 'dExtHalLon', null, null, null, null, false) ?>
						</div>
					</div>
				</div>
			</li>
			<li class="accordion-navigation">
				<a href="#ostaleMjere" role="tab" id="ostaleMjere-heading" aria-controls="ostaleMjere">Ostalo</a>
				<div id="ostaleMjere" class="content" role="tabpanel" aria-labelledby="ostaleMjere-heading">
					<div class="row">
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Ne hoda od', 'text', 'neHoda', 'neHoda') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Hoda sa štakama od', 'text', 'hodSaStakama', 'hodSaStakama') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Stoji od', 'text', 'stoji', 'stoji') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Hoda sa štapovima od', 'text', 'hodSaStapovima', 'hodSaStapovima') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Hoda sa aparatima od', 'text', 'hodSaAparatima', 'hodSaAparatima') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Hoda samostalno od', 'text', 'hodSamostalno', 'hodSamostalno') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Hoda sa korzetom od', 'text', 'hodSaKorzetom', 'hodSaKorzetom') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Ide stepenicama od', 'text', 'ideStepenicama', 'ideStepenicama') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Pomoćni aparati', 'text', 'pomocniAparati', 'pomocniAparati') ?>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<?= Html::Input('Scoliosis i deformiteti', 'text', 'scoliosis', 'scoliosis') ?>
						</div>
					</div>					
				</div>
			</li>	
		</ul>
	</fieldset>
	<div class="row mb40 mt40">
		<div class="large-12 columns">
			<?= Html::Button('Unesi nove mjere', array('siroko', 'success', 'spremi', 'round', 'button', 'unesiMjere')) ?>
		</div>
	</div>
</div>