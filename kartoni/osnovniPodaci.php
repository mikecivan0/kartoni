<div class="large-12 columns mt40">
	<div class="row">
		<div class="large-3 columns">
			<?= Html::InputSaGreskom($greske, 'ime', 'Ime', $pacijent -> ime, 'text', array('placeholder'=>'Ime','autocomplete'=>'off')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::InputSaGreskom($greske, 'prezime', 'Prezime', $pacijent -> prezime, 'text', array('placeholder'=>'Prezime','autocomplete'=>'off')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::InputSaGreskom($greske, 'godiste', 'Dob(godište)', $pacijent -> godiste, 'text', 
									 array('pattern'=>'^(19|20)\d{2}$','placeholder'=>'1956','autocomplete'=>'off')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Select('Spol', 'spol', 'spol', null, array( 
														   		array('id' => 'musko', 'text' => 'muško', 'value' => '1'), 
														   		array('id' => 'zensko', 'text' => 'žensko', 'value' => '0')
															)
							 ) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<?= Html::Input('Zanimanje', 'text', 'zanimanje', 'zanimanje', null, null, $pacijent -> zanimanje, array('placeholder'=>'Zanimanje')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::InputSaGreskom($greske, 'mbo', 'MBO / broj EU iskaznice', $pacijent -> mbo, 'text', array('placeholder'=>'123456789')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Broj dopunskog osiguranja', 'text', 'dopunsko', 'dopunsko', null, null, $pacijent -> dopunsko, array('placeholder'=>'12345678')) ?>
		</div>
		<div class="large-3 columns">
			<?= Html::Input('Telefon', 'text', 'telefon', 'telefon', null, null, $pacijent -> telefon, array('placeholder'=>'091/123-4567')) ?>
		</div>
	</div>
</div>