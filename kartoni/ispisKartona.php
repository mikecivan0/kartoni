<?php
if(!isset($_GET["id"])){
	header("location: index.php");
}else{	
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/mpdf/mpdf.php';
include_once '../alati/Alati.php';
include_once '../klase/SQL.php';
include_once '../klase/Karton.php';
include_once '../klase/Mjera.php';

$styleNaslovaSekcije = 'style="font-size: 0.9rem; width: 205mm;"';
$styleTekstaSekcije = 'style="font-size: 0.9rem; width: 190mm; padding-left: 15mm; margin-bottom: 3mm;"';
$styleOsnovnihPodataka = 'style="font-size: 0.9rem; width: 205mm;"';
$styleOsnovnihPodatakaZadjni = 'style="font-size: 0.9rem; width: 205mm; margin-bottom: 10mm;"';


$karton = new Karton();
$karton->find($_GET["id"]);

$mjere = new Mjera($karton->osoba_id);

$spol = ($karton->spol==0) ? 'žensko' : 'muško';
$zabiljeske = ($karton->zabiljeske!="") ? $karton->zabiljeske : "-<br />-<br />-";

$mpdf = new Mpdf();

$html= '<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<img src="../img/zaglavlje.jpg" /><hr />';
$html .= '<div style="text-align: center; margin-top: 10mm; margin-bottom: 10mm;"><b>FIZIOTERAPEUTSKI KARTON</b></div>';
$html .= '<div ' . $styleOsnovnihPodataka. '>Ime i prezime: <b>' . $karton->ime . " " . $karton->prezime . '</b></div>
		  <div ' . $styleOsnovnihPodataka. '>Spol: <b>' . $spol . '</b></div> 
		  <div ' . $styleOsnovnihPodataka. '>Godina rođenja: <b>' . $karton->godiste . '.</b></div> ';
		  
$html .= ($karton->zanimanje!="") ? '<div ' . $styleOsnovnihPodataka. '>Zanimanje: <b>' . strtolower($karton->zanimanje) . '</b></div>' : null;

$html .= '<div ' . $$styleOsnovnihPodataka. '>Terapija provedena: <b>' . Alati::datum($karton->prvaTh) . '-' . Alati::datum($karton->zadnjaTh) . '</b></div>
		  <div ' . $styleOsnovnihPodatakaZadjni. '>Broj upisa u evidenciju: <b>' . $karton->upis . '</b></div>';		  
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Liječnička dijagnoza:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->lDijagnoza . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Funkcionalna dijagnoza:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->fDijagnoza . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Početna procjena:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->pDijagnoza . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Podaci bitni za fizioterapiju:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->vazniPodaci . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Ciljevi fizioterapije:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->ciljevi . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Plan fizioterapije:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->plan . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Zabilješke tijekom terapije:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $zabiljeske . '</div>';
$html .= '<div ' . $styleNaslovaSekcije. '><i><b>Mišljenje i zaključak:</b></i></div>';
$html .= '<div ' . $styleTekstaSekcije. '>' . $karton->zakljucak . '</div>';
$html .= '<div style="margin-top: 30mm; padding-left: 110mm; width: 205mm;">______________________________</div>';
$html .= '<div style="margin-top: 0; padding-left: 125mm; width: 205mm; font-size: 0.7rem;">Potpis fizioterapeuta</div>';


if($mjere->isMesurements()){
	$mpdf->WriteHTML($html);
	$mpdf->AddPage();
	$html2 = '<div style="margin-bottom: 20mm; width: 205mm;"><img src="../img/zaglavlje.jpg" /><hr />';
	$html2.= '<h4 style="margin-top: 15mm;">Dodatak fizioterapeutskom kartonu</h4></div>';
	$html2 .= '<div>' . $mjere->ispisMjera($doktorica=true) . '</div>';
	$html2 .= '</body></html>';
	$mpdf->WriteHTML($html2);	
}else{
	$html .= '</body></html>';
	$mpdf->WriteHTML($html);	
}

$mpdf->Output();
exit;

echo $html . $html2;

}
?>