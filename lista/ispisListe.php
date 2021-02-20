<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../klase/SQL.php';
include_once '../klase/Lista.php';

$title = 'Ispis liste';
$lista = new Lista();
$popis = $lista->findAll();

include_once '../masters/masterHead.php';


if(!empty($popis)): ?>
	<table style="border-collapse=collapse; border: 2px solid black;" class="siroko">
		<thead style="border: 2px solid black;">
			<td style="border: 2px solid black; text-align: center;">Prezime, ime i godište</td>
			<td style="border: 2px solid black; width:30mm; text-align: center;">Telefon</td>
			<td style="border: 2px solid black; width:10mm; text-align: center;">Vrijeme</td>
			<td style="border: 2px solid black; width:15mm; text-align: center;">Uputnica</td>					
			<td style="border: 2px solid black; width:10mm; text-align: center;">Dolazi</td>					
			<td style="border: 2px solid black; min-width: 60mm; text-align: center;">Napomena</td>			
		</thead>
		<tbody>
		<?php foreach($popis as $podatak){ 
			$nastavno = ($podatak->nastavno==true) ? "+" : null;
		?>
			<tr style="border: 1px solid black; height: 0.82rem;">
				<td style="border: 1px solid black; text-align: center; height: 0.8rem;"><?= $podatak->prezime . " " . $podatak->ime . ", " . $podatak->godiste?></td>						
				<td style="border: 1px solid black; text-align: center; height: 0.8rem;"><?= $podatak->telefon ?></td>						
				<td style="border: 1px solid black; text-align: center; height: 0.8rem;"><?= $podatak->vrijemeDolaska ?></td>						
				<td style="border: 1px solid black; text-align: center; height: 0.8rem;"><?= $nastavno ?></td>	
				<td style="border: 1px solid black; height: 0.8rem;"></td>					
				<td style="border: 1px solid black; text-align: left; font-size: 0.7rem;"><?= $podatak->napomena ?></td>						
				
			</tr>
		<?php } ?>
		<tbody>
	</table>
<?php endif ?>
<script src="<?= $putanjaApp ?>js/jquery-1.9.1.js"></script>
<script src="<?= $putanjaApp ?>js/lista/ispisListe.js"></script>
</html>
