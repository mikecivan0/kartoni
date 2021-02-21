<?php
class Filter extends SQL{
	
	function __construct($putanjaApp){		
		$this->putanjaApp = $putanjaApp;
	}
	
	public function dupliDO(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select dopunsko from kartoni_osobe where dopunsko!='';");
		$izraz->execute();	
		$svaDopunska = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();
		$svaDO = array();
		$dupli = array();


			
		foreach($svaDopunska as $osoba){
			array_push($svaDO, $osoba->dopunsko);	
		}

		foreach(array_count_values($svaDO) as $val => $c){
			if($c > 1) {
				array_push($dupli, $val);	
			}	
		}


		if(!empty($dupli)){
			foreach($dupli as $key => $value){
				$izraz = $veza->prepare("select id, concat(prezime,' ', ime) as osoba, godiste, dopunsko from kartoni_osobe
										 where dopunsko=:dopunsko;");
				$izraz->bindParam(":dopunsko", $value);
				$izraz->execute();	
				$duplikati = $izraz->fetchAll(PDO::FETCH_OBJ);
				
				foreach($duplikati as $osoba){
					$str = "<a target='_blank' href='" . $this->putanjaApp . "osobe/pacijenti.php?id=" . $osoba->id . "'>" . 
										 $osoba->osoba . ", " . $osoba->godiste .
							"</a>";
					array_push($array, $str);
				}
			}
		}

		$this->ispis($array);
		
	}
	
	public function dupliUpis(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select upis from kartoni_kartoni where upis!='' order by length(upis),upis;");
		$izraz->execute();	
		$upisi = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();
		$sviUpisi = array();
		$dupliUpisi = array();
				
		foreach($upisi as $upis){
			array_push($sviUpisi, $upis->upis);	
		}
			
		foreach(array_count_values($sviUpisi) as $val => $c){
			if($c > 1) {
				array_push($dupliUpisi, $val);	
			}	
		}	

		if(!empty($dupliUpisi)){
			foreach($dupliUpisi as $key => $value){
				$izraz = $veza->prepare("select concat(o.prezime,' ', o.ime) as osoba, o.godiste, k.id, k.upis 
										 from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id 
										 where k.upis=:upis
										 order by length(k.upis),k.upis;");
				$izraz->bindParam(":upis", $value);
				$izraz->execute();	
				$duplikati = $izraz->fetchAll(PDO::FETCH_OBJ);
				
				foreach($duplikati as $osoba){
					$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $osoba->id . "&tab=ostaliPodaci'>" . 
										 $osoba->osoba . ", " . $osoba->godiste . ", broj upisa " . $osoba->upis .
							"</a>";
					array_push($array, $str);
				}
			}
		}	
	

		$this->ispis($array);
	}
	
	public function dupliMBO(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select mbo from kartoni_osobe;");
		$izraz->execute();	
		$sviMBO = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();
		$sviMBOArray = array();
		$dupliMBO = array();


			
		foreach($sviMBO as $osobaMBO){
			array_push($sviMBOArray, $osobaMBO->mbo);	
		}

		foreach(array_count_values($sviMBOArray) as $val => $c){
			if($c > 1) {
				array_push($dupliMBO, $val);	
			}	
		}

		if(!empty($dupliMBO)){
			foreach($dupliMBO as $key => $value){
				$izraz = $veza->prepare("select id, concat(prezime,' ', ime) as osoba, godiste, mbo from kartoni_osobe
										 where mbo=:mbo;");
				$izraz->bindParam(":mbo", $value);
				$izraz->execute();	
				$duplikatiMBO = $izraz->fetchAll(PDO::FETCH_OBJ);
				
				foreach($duplikatiMBO as $osobaMB){
					$str = "<a target='_blank' href='" . $this->putanjaApp . "osobe/pacijenti.php?id=" . $osobaMB->id . "'>" . 
										 $osobaMB->osoba . ", " . $osobaMB->godiste .
							"</a>";
					array_push($array, $str);
				}
			}
		}


		$this->ispis($array);

		
	}
	
	public function cilj(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.ciljevi='' or k.ciljevi=null
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezCiljeva = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezCiljeva)){	
			foreach($kartoniBezCiljeva as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function datumPD(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis,k.pDijagnoza from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.pDijagnoza != ''
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezDatumaPD = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezDatumaPD)){	
			foreach($kartoniBezDatumaPD as $karton){
				if(!preg_match('/^(?<!\d)(\d{1}|\d{2})\.(\d{1}|\d{2})\.\d{4}\.(?!\d)/', $karton->pDijagnoza)){
					$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
											 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
								"</a>";
					array_push($array, $str);
				}
			}	
		}

		$this->ispis($array);
	}
	
	public function datumZakljucka(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis,.k.zakljucak from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.zakljucak != ''
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezDatumaZakljucka = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezDatumaZakljucka)){	
			foreach($kartoniBezDatumaZakljucka as $karton){
				if(!preg_match('/^(?<!\d)(\d{1}|\d{2})\.(\d{1}|\d{2})\.\d{4}\.(?!\d)/', $karton->zakljucak)){
					$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
											 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
								"</a>";
					array_push($array, $str);
				}	
			}	
		}

		$this->ispis($array);
	}
	
	public function funkcionalnaDg(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.fDijagnoza='' or k.fDijagnoza=null
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezFD = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezFD)){	
			foreach($kartoniBezFD as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function lijecnickaDg(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.lDijagnoza='' or k.lDijagnoza=null
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezLD = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezLD)){	
			foreach($kartoniBezLD as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function pocetnaProcjena(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.pDijagnoza='' or k.pDijagnoza=null
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezPD = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezPD)){	
			foreach($kartoniBezPD as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function plan(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.plan='' or k.plan=null
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezPlana = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezPlana)){	
			foreach($kartoniBezPlana as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function dolasci(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select k.id, k.upis, concat(o.prezime,' ',o.ime,', ',o.godiste,'.') as osoba 
						 from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id 
						 where k.id not in (select distinct karton_id from kartoni_terapije)
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezTerapija = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezTerapija)){	
			foreach($kartoniBezTerapija as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=datumiTerapija'>" . 
									 $karton->osoba. ", broj upisa " . $karton->upis . 
						"</a>";
				array_push($array, $str);	
			}	
		}

		$this->ispis($array);
	}
	
	public function upis(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.upis='' or k.upis is null
						 order by o.prezime,o.ime;");
		$izraz->execute();	
		$kartoniBezUpisa = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezUpisa)){	
			foreach($kartoniBezUpisa as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "." .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function zakljucak(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where (k.zakljucak='' or k.zakljucak=null) and k.upis!=''
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniBezZakljucka = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniBezZakljucka)){	
			foreach($kartoniBezZakljucka as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	public function nedostaje(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select upis from kartoni_kartoni 
						 where upis!='' and upis REGEXP '^[0-9]+$'
						 order by length(upis),upis;");
		$izraz->execute();	
		$kartoni = $izraz->fetchAll(PDO::FETCH_OBJ);

		$largeAttr = " class='hide-for-small-only'";
		$smallAttr = " style='font-size: 1rem;' class='show-for-small-only'";
		$svi = array();
		$nema = array();
		$nemaUProtokolu = array('013','015','018','020','023','024','115','124','266','340','506','537','542','1040','1444','1605');
		
		if(!empty($kartoni)){
			foreach($kartoni as $karton){
				array_push($svi, $karton->upis);	
			}	
	
			$prvi = reset($svi);
			$zadnji = end($svi);
	
			for($i=$prvi;$i<=$zadnji;$i++){
				if(!in_array($i,$svi)){
					array_push($nema, $i);
				}
			}
		}
		
		if(!empty($nema)){
			echo "<h5" . $largeAttr . ">Brojevi upisa između <b>" . $prvi . "</b> i <b>" . $zadnji . "</b></h5>";
			echo "<h5" . $smallAttr . ">Brojevi upisa između <b>" . $prvi . "</b> i <b>" . $zadnji . "</b></h5>";
			echo "<ol>";
			foreach($nema as $key => $value){
				$broj = (in_array($value, $nemaUProtokolu)) ? "broj upisa  <b>" . str_pad($value, 3, "0", STR_PAD_LEFT) . "</b> (nema u protokolu)" : "broj upisa <b>" . str_pad($value, 3, "0", STR_PAD_LEFT) . "</b>";
				echo "<li>" . $broj . "</li>";
			}
			echo "</ol>";
		}else{
			echo "Sve OK <img style='width: 20px;' src='../img/check.png' alt='check'>";
		}	
	}
	
	public function neispravanUpis(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select o.ime,o.prezime,o.godiste,k.id,k.upis from kartoni_osobe o 
						 inner join kartoni_kartoni k on k.osoba_id=o.id
						 where k.upis!='' and k.upis not REGEXP '^[0-9]+$'
						 order by length(k.upis),k.upis;");
		$izraz->execute();	
		$kartoniSaNeispravnimBrojemUpisa = $izraz->fetchAll(PDO::FETCH_OBJ);

		$array = array();

		if(!empty($kartoniSaNeispravnimBrojemUpisa)){	
			foreach($kartoniSaNeispravnimBrojemUpisa as $karton){
				$str = "<a target='_blank' href='" . $this->putanjaApp . "kartoni/promjena.php?id=" . $karton->id . "&tab=ostaliPodaci'>" . 
										 $karton->prezime . " " . $karton->ime . ", " . $karton->godiste . "., broj upisa " . $karton->upis .
							"</a>";
				array_push($array, $str);
			}	
		}

		$this->ispis($array);
	}
	
	private function ispis($array){
		if(!empty($array)){
			echo "<ol>"; 	
			foreach($array as $key => $value){
				echo "<li>" . $value . "</li>";
			}
			echo "</ol>"; 
		}else{
			echo "Sve OK <img style='width: 20px;' src='../img/check.png' alt='check'>";
		}	
		
		
	}
}	
	
