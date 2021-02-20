<div class="large-12 columns mt40">
	<div class="row">
		<div class="large-3 end columns">
			<?= Html::Input('Broj upisa', 'text', 'upis', 'upis', null, null, $karton -> upis) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<?= Html::Input('Liječnička dijagnoza', 'text','lDijagnoza', 'lDijagnoza', null, null, $karton -> lDijagnoza) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Input('Funkcionalna dijagnoza', 'text','fDijagnoza', 'fDijagnoza', null, null, $karton -> fDijagnoza) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Početna procjena', 'pDijagnoza', 'pDijagnoza', null, null, $karton->pDijagnoza, array("rows"=>4)) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Podaci važni za fizioterapiju (komorbitet, pacemaker, medikamenti i sl.)', 
							'vazniPodaci', 'vazniPodaci', null, null, $karton -> vazniPodaci, array("rows"=>3)) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Ciljevi fizioterapije', 'ciljevi', 'ciljevi', null, null, $karton -> ciljevi, array("rows"=>3)) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Plan fizioterapije', 'plan', 'plan', null, null, $karton -> plan, array("rows"=>3)) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Zabilješke tijekom procesa fizioterapije i kontrolne procjene', 
							'zabiljeske', 'zabiljeske', null, null, $karton -> zabiljeske, array("rows"=>3)) ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Textarea('Mišljenje (zaključak) po obavljenoj fizioterapiji', 
							'zakljucak', 'zakljucak', null, null, $karton -> zakljucak, array("rows"=>3)) ?>
		</div>
	</div>
</div>