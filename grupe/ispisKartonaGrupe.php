<?php
ini_set('max_execution_time', 600);
if(!isset($_POST["odDatuma"]) || !isset($_POST["doDatuma"])){
	header("location: index.php");
}else{	
$_POST["ispisKartona"] = true; //postavljeno kao filter je li klasu koristi doktorica ili se koristi za ispis kartona grupe
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isAuth($ida, $putanjaApp);

include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../alati/mpdf/mpdf.php';
include_once '../klase/SQL.php';
include_once '../klase/ispisKartona/Pacijent.php';
include_once '../klase/ispisKartona/Mjera.php';
include_once '../klase/ispisKartona/Karton.php';

if(isset($_POST["odDatuma"])){
	
	$styleNaslovaSekcije = 'style="font-size: 0.8rem; width: 205mm;"';
	$styleTekstaSekcije = 'style="font-size: 0.8rem; width: 190mm; padding-left: 15mm; margin-bottom: 0.5mm;"';
	$styleOsnovnihPodataka = 'style="font-size: 0.8rem; width: 205mm;"';
	$styleOsnovnihPodatakaZadnji = 'style="font-size: 0.8rem; width: 205mm; margin-bottom: 10mm;"';	

	$kartoni2 = new Karton();
	$pacijentiKojiSuUIntervalu = $kartoni2->osobaIdPremaDatumima($_POST["odDatuma"],$_POST["doDatuma"]);
	
	if(!empty($pacijentiKojiSuUIntervalu)){
		
		$mpdf = new Mpdf();
			
		foreach($pacijentiKojiSuUIntervalu as $pacijentKojiJeUIntervalu){
			$lDijagnoze = array();
			$fDijagnoze = array();
			$pDijagnoze = array();
			$vazniPodaci = array();
			$ciljevi = array();
			$planovi = array();
			$zabiljeske = array();
			$zakljucci = array();
			$prviIZadnjiDatumiTerapija = array();
			$pacijent = null;
			$ispisMjera = null;
			$upisi = array();
			$mpdf->AddPage();
			
			$pacijentKojiJeUIntervaluId = $pacijentKojiJeUIntervalu->osoba_id;
			$pacijent = new Pacijent();
			$pacijent = $pacijent->find($pacijentKojiJeUIntervaluId);
			
			$mjere = new Mjera($pacijentKojiJeUIntervaluId);
			$ispisMjera = $mjere->ispisMjera($doktorica=true);
			
			$kartoni = new Karton();
			$kartoni = $kartoni->findByPId($pacijentKojiJeUIntervaluId);
			
			$spol = ($pacijent->spol==0) ? 'žensko' : 'muško';
			$dopunsko = (strlen($pacijent->dopunsko)>0) ? $pacijent->dopunsko : 'nema';
			
			if(!empty($kartoni)){
	
				//obrada brojeva upisa da bi zadnji ili jedini bio bold
				$brojKartona = count($kartoni);
				$i = 1;	
				foreach ($kartoni as $karton) {
					
					if($brojKartona != $i) {
						array_push($upisi,$karton->upis); 
						$i++;
					} else {
						array_push($upisi,"<b>" . $karton->upis . "</b>"); 
					}
					if($karton->lDijagnoza!="" && !in_array($karton->lDijagnoza, $lDijagnoze)) { array_push($lDijagnoze, $karton->lDijagnoza); }
					if($karton->fDijagnoza!="" && !in_array($karton->fDijagnoza, $fDijagnoze)) { array_push($fDijagnoze, $karton->fDijagnoza); }
					if($karton->pDijagnoza!="" && !in_array($karton->pDijagnoza, $pDijagnoze)) { array_push($pDijagnoze, $karton->pDijagnoza); }
					if($karton->vazniPodaci!="" && !in_array($karton->vazniPodaci, $vazniPodaci)) { array_push($vazniPodaci, $karton->vazniPodaci); }
					if($karton->ciljevi!="" && !in_array($karton->ciljevi, $ciljevi)) { array_push($ciljevi, $karton->ciljevi); }
					if($karton->plan!="" && !in_array($karton->plan, $planovi)) { array_push($planovi, $karton->plan); }
					if($karton->zabiljeske!="" && !in_array($karton->zabiljeske, $zabiljeske)) { array_push($zabiljeske, $karton->zabiljeske); }					
					if($karton->zakljucak!="" && !in_array($karton->zakljucak, $zakljucci)) { array_push($zakljucci, $karton->zakljucak); }					
								
					$prvaTh = ($karton->prvaTh=="nema upisanih terapija") ? $karton->prvaTh : Alati::datum($karton->prvaTh);
					$zadnjaTh = ($karton->zadnjaTh=="nema upisanih terapija") ? "" : " - " . Alati::datum($karton->zadnjaTh);					
					$prikazDatumaTerapija = $prvaTh . $zadnjaTh;					
					array_push($prviIZadnjiDatumiTerapija, $prikazDatumaTerapija);	
				}
							
			}
			
			$datumiTerapija = implode(", ", $prviIZadnjiDatumiTerapija);
			$sviUpisi = implode(", ", $upisi);
			
			
			$html = '<html>
						<head>
						<meta charset="UTF-8">
						</head>
						<body>
						<img src="../img/zaglavlje.jpg" /><hr />';
			$html .= '<div style="width: 205mm; text-align:center; margin-bottom: 10mm;"><h3>FIZIOTERAPEUTSKI KARTON</h3></div>';
			$html .= '<div ' . $styleOsnovnihPodataka. '><i>Ime, prezime i godište: </i><b>' . $pacijent->ime . ' ' . $pacijent->prezime . ', ' . $pacijent->godiste . '.</b></div>
					  <div ' . $styleOsnovnihPodataka. '><i>Spol: </i>' . $spol . '</div> 
					  <div ' . $styleOsnovnihPodataka. '><i>MBO: </i><b>' . $pacijent->mbo . '</b>, dopunsko osiguranje: <b>' . $dopunsko . '</b></div>';
					  
			$html .= ($pacijent->zanimanje!="") ? '<div ' . $styleOsnovnihPodataka. '><i>Zanimanje: </i>' . strtolower($pacijent->zanimanje) . '</div>' : null;

			$html .= '<div ' . $styleOsnovnihPodataka. '><i>Telefon: </i>' . $pacijent->telefon . '</div>
					  <div ' . $styleOsnovnihPodataka. '><i>Brojevi kartona: </i>' . $sviUpisi . '</div>
					  <div ' . $styleOsnovnihPodatakaZadnji. '><i>Ciklusi provedenih terapija: </i>' . $datumiTerapija . '</div> ';
					  
					  
			if(!empty($lDijagnoze)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Liječnička dijagnoza</i></b></div>';
				foreach($lDijagnoze as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}

			if(!empty($fDijagnoze)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Funkcionalna dijagnoza</i></b></div>';
				foreach($fDijagnoze as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}

			if(!empty($pDijagnoze)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Početna procjena</i></b></div>';
				foreach($pDijagnoze as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}

			if(!empty($vazniPodaci)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Podaci važni za fizioterapiju</i></b></div>';
				foreach($vazniPodaci as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}

			if(!empty($ciljevi)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Ciljevi fizioterapije</i></b></div>';
				foreach($ciljevi as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}
						
			if(!empty($planovi)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Plan fizioterapije</i></b></div>';
				foreach($planovi as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}
						
			if(!empty($zabiljeske)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Zabilješke tijekom fizioterapije</i></b></h5>';
				foreach($zabiljeske as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}
				
			if(!empty($zakljucci)){
				$html .= '<div ' . $styleNaslovaSekcije . '><b><i>Zaključak po provedenoj fizioterapiji</i></b></div>';
				foreach($zakljucci as $key => $value) { $html .= '<div ' . $styleTekstaSekcije .'>' . $value . '</div>'; }
			}	
			$html .= '<div style="margin-top: 30mm; padding-left: 110mm; width: 205mm;">______________________________</div>';
			$html .= '<div style="margin-top: 0; padding-left: 125mm; width: 205mm; font-size: 0.7rem;">Potpis fizioterapeuta</div>';
			
			if($mjere->isMesurements()){
				$mpdf->WriteHTML($html);
				$mpdf->AddPage();
				$html2 = '<div style="margin-bottom: 5mm; width: 205mm;"><img src="../img/zaglavlje.jpg" /><hr /></div>';
				$html2 .= '<div style="margin-bottom: 10mm; font-size: 0.8rem;"><b>' . $pacijent->ime . ' ' . $pacijent->prezime . ', ' . $pacijent->godiste . '.</b></div>';
				$html2 .= '<div style="margin-bottom: 15mm; width: 100%; text-align:center;"><h4>Dodatak fizioterapeutskom kartonu</h4></div>';
				$html2 .= '<div>' . $mjere->ispisMjera($doktorica=true) . '</div>';
				$html2 .= '</body></html>';
				$mpdf->WriteHTML($html2);	
			}else{
				$html .= '</body></html>';
				$mpdf->WriteHTML($html);	
			}
			
			
			
		}	

		$mpdf->Output();
		
	}
	
	
}


}
?>