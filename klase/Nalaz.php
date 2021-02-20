<?php
class Nalaz extends SQL{
	
	public $id;
	public $osoba_id;
	public $datum;
	public $lDg;
	public $fDg;
	public $pDg;
	public $vazniPodaci;
	public $plan;
	
	function __construct(){		
		$this->id = '';
		$this->osoba_id = '';
		$this->datum = '';
		$this->lDg = '';
		$this->fDg = '';
		$this->pDg = '';		
		$this->vazniPodaci = '';
		$this->plan = '';
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function setOsobaId($osoba_id){
		$this->osoba_id = $osoba_id;
	}
	
	public function setDatum($datum){
		$this->datum = $datum;
	}
	
	public function setLDg($lDg){
		$this->lDg = $lDg;
	}
	
	public function setFDg($fDg){
		$this->fDg = $fDg;
	}
	
	public function setPDg($pDg){
		$this->pDg = $pDg;
	}
	
	public function setVazniPodaci($vazniPodaci){
		$this->vazniPodaci = $vazniPodaci;
	}
	
	public function setPlan($plan){
		$this->plan = $plan;
	}
	
	public function findByOId(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id = $this->osoba_id;
		
		//traženje podataka nalaza	po osoba_id				
		$izraz = $veza->prepare("select * from kartoni_nalazi where osoba_id=:osoba_id order by datum");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->execute();
		$nalazi = $izraz->fetchAll(PDO::FETCH_OBJ);		

		return $nalazi;
	}			
}
