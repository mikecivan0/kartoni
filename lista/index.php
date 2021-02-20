<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Lista.php';


$footerScript .= '<script src="' . $putanjaApp . 'js/lista/index.js"></script>';
$title = 'Pretraga pacijenata za listu za zvati';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

$lista = new Lista();
$popis = $lista->findAll();

?>
<div class="row mt40 polja">	
	<div class="large-12 columns center">
		<h3 class="plavaSlova"><i>Pronađite pacijenata za dodati na listu za zvati</i></h3>
	</div>
	<hr>
	
	<div class="large-8 end columns mb40">
		<?= Html::Input('<b>Pretraga pacijenata</b> (pretraga po imenu i/ili prezimenu pacijenta)', 'text', 'pacijent', 'pacijent', null, null, null, array('autofocus'=>'autofocus')) ?>
	</div>	
	
	<?php if(!empty($popis)){ ?>
		<div class="large-12 columns">
			<h5 class="plavaSlova">Trenutna lista</h5>
			<table style="border-collapse=collapse; border: 2px solid black;" class="siroko">
				<thead style="border: 2px solid black;">
					<td style="border: 2px solid black; text-align: center;">Prezime, ime i godište</td>
					<td style="border: 2px solid black; width:35mm; text-align: center;">Telefon</td>
					<td style="border: 2px solid black; width:15mm; text-align: center;">Vrijeme</td>
					<td style="border: 2px solid black; width:15mm; text-align: center;">Uputnica</td>					
					<td style="border: 2px solid black; width:15mm; text-align: center;">Dolazi</td>					
					<td style="border: 2px solid black; min-width: 60mm; text-align: center;">Napomena</td>
					<td style="border: 2px solid black; min-width: 10mm; text-align: center;">Izmjena</td>							
					<td style="border: 2px solid black; width: 10mm;" text-align: center;>Brisanje</td>					
				</thead>
				<tbody>
				<?php foreach($popis as $podatak){ 
						$nastavno = ($podatak->nastavno==true) ? "+" : null;
				?>
					<tr style="border: 1px solid black;">
						<td style="border: 1px solid black; text-align: center;">
							<?= $podatak->prezime . " " . $podatak->ime . ", " .  $podatak->godiste ?>
						</td>						
						<td style="border: 1px solid black; text-align: center;"><?= $podatak->telefon ?></td>						
						<td style="border: 1px solid black; text-align: center;"><?= $podatak->vrijemeDolaska ?></td>						
						<td style="border: 1px solid black; text-align: center;"><?= $nastavno ?></td>	
						<td style="border: 1px solid black;"></td>										
						<td style="border: 1px solid black; font-size: 0.8rem;"><?= $podatak->napomena ?></td>							
						<td style="border: 1px solid black; text-align: center;">
							<a href="promjena.php?id=<?= $podatak->id ?>">
								<img src="../img/pen.png" />
							</a>
						</td>
						<td style="border: 1px solid black; text-align: center;">
							<img src="../img/bin.png" onclick="brisanjeUnosa(<?= $podatak->id ?>);" />
						</td>
					</tr>
				<?php } ?>
				<tbody>
			</table>
		</div>	
		<div class="large-6 columns">
			<?=  Html::Button('Obriši listu', array('siroko', 'alert', 'spremi', 'round', 'button', 'brisanjeListe')) ?>
		</div>
		<div class="large-6 columns">
			<a href="ispisListe.php" target="_blank">
				<?=  Html::Button('Ispiši listu', array('siroko', 'success', 'spremi', 'round', 'button', 'ispisListe')) ?>
			</a>			
		</div>
	<?php } ?>
	
</div>

<?php
include_once '../masters/masterBottom.php';
?>

