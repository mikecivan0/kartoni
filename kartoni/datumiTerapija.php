<div class="large-8 large-centered columns">
	<div class="row">
		<fieldset>
			<legend>Unos novih terapija</legend>
			<div class="large-4 columns">
				<?= Html::Input('Datum prve terapije', 'date', 'datumPrveTerapije', 'datumPrveTerapije', null, null, $pt) ?>
			</div>
			<div class="large-4 columns">
				<?= Html::Input('Datum zadnje terapije', 'date', 'datumZadnjeTerapije', 'datumZadnjeTerapije', null, null, $zt) ?>
			</div>			
			<div class="large-4 columns">				
				<?= Html::Button('Unesi th', array('siroko', 'spremi', 'round', 'button', 'unosTerapija', 'mt20')) ?>				
			</div>
			<div class="large-12 columns">
				<p class="red">*od prve do zadnje terapije može biti najviše 30 dana razlike</p>
				<p class="red">*ukoliko se unosi samo jedna terapija datum prve i zadnje terapije je isti dan</p>
			</div>
		</fieldset>		
	</div>	
</div>

<div class="large-6 large-centered columns mt40">
	<?php if(!empty($terapije)){ ?>
		<table class="siroko">
			<thead>
				<tr>				
					<th style="height: 39px; width: 20px; margin: 0; padding: 0 0 0 10;"><img id="brisiDatumeTerapija" src="<?= $putanjaApp . "img/bin.png" ?>" style="display: none;"/></th>
					<th style="padding-top: 13px;"><input type="checkbox" id="sviDatumi" style="margin: 0 auto;" /></th>
					<th class="center">Broj</th>
					<th class="center">Datum terapije</th>
					<th class="center">Uređivanje</th>
				</tr>
			</thead>
			<tbody id="podaci">
				<?php
					$i = 1;
					foreach ($terapije as $terapija){ ?>					
						<tr>
							<td></td>
							<td>
								<input namjena="datumTerapijeCheckbox" type="checkbox" name="datumTerapije[]" style="margin: 0 auto;" value="<?= $terapija->id ?>"/>
							</td>
							
							<td class="center"><?= $i . "."?></td>
							<td id="datum<?= $terapija->id ?>" class="center"><?= Alati::datum($terapija->datum)  ?></td>
							<td class="center">
								<a href="#" data-reveal-id="modalTerapije" class="promjenaTerapije" id="<?= $terapija->id ?>">
									<img src="<?= $putanjaApp ?>img/pen.png"/>
								</a>
							</td>
						</tr>					
				<?php
					$i++; 
					} ?>
			</tbody>
		</table>
	<?php 
		}else{
			echo "Nema upisanih datuma terapija";
		} 
	?>
</div>
