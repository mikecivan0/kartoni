<div id="modalTerapije" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	<?= Html::Input(null, "hidden", "hfTerapijaId", "hfTerapijaId") ?>
	<h2 id="modalTitle">Promjena datuma terapije</h2>	
	<div class="large-12 columns">		
		<div class="large-12 columns">
			<?= Html::Input('Datum', 'date', 'datumPromjene', 'datumPromjene') ?>
		</div>
		<div class="large-12 columns">
			<?= Html::Button("Izmijeni", array("close-reveal-modal","siroko","mt40"),
									  array("id"=>"gumbModalaTerapije"),
									  array("font-size"=>"1.2rem","position"=>"relative","color"=>"white","right"=>"0","top"=>"1rem")) 
			?>
		</div>
	</div>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>