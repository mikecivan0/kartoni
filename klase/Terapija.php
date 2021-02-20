<?php
class Terapija extends SQL{
	
	public $id;
	public $karton_id;
	public $osoba_id;
	public $prvaTh;
	public $zadnjaTh;
	
	function __construct(){		
		$this->id = '';
		$this->karton_id = '';
		$this->osoba_id = '';
		$this->prvaTh = '';
		$this->zadnjaTh = '';
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setKartonId($karton_id){
		$this->karton_id = $karton_id;
	}
	
	public function setOsobaId($osoba_id){
		$this->osoba_id = $osoba_id;
	}
	
	public function setPrvaTh($prvaTh){
		$this->prvaTh = $prvaTh;
	}
	
	public function setZadnjaTh($zadnjaTh){
		$this->zadnjaTh = $zadnjaTh;
	}
	
	private $neradniDani = array('01.01.2018.','02.04.2018.','01.05.2018.','31.05.2018.','22.06.2018.','25.06.2018.','15.08.2018.','08.10.2018.','01.11.2018.','25.12.2018.','26.12.2018.','01.01.2019.','22.04.2019.','01.05.2019.','20.06.2019.','25.06.2019.','05.08.2019.','15.08.2019.','08.10.2019.','01.11.2019.','25.12.2019.','26.12.2019.','01.01.2020.','06.01.2020.','13.04.2020.','01.05.2020.','11.06.2020.','22.06.2020.','05.08.2020.','18.11.2020.','25.12.2020.');
	
	public function findByCard(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$karton_id = $this->karton_id;
		
		//traženje terapija određenog kartona
		$izraz = $veza->prepare("select * from kartoni_terapije where karton_id=:karton_id order by datum;");
		$izraz->bindParam(":karton_id", $karton_id);
		$izraz->execute();		
		return $izraz->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function pocetakZadnjegSetaTerapija(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$osoba_id = $this->osoba_id;
		
		//traženje broja upisa zadnjeg kartona
		$izraz = $veza->prepare("select id from kartoni_kartoni where osoba_id=:osoba_id order by length(upis) desc,upis desc limit 1;");
		$izraz->bindParam(":osoba_id", $osoba_id);
		$izraz->execute();		
		$idZadnjegKartona = $izraz->fetch(PDO::FETCH_OBJ);
		
		if(!empty($idZadnjegKartona)){
			$karton_id = $idZadnjegKartona->id;
			
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");
			$izraz->bindParam(":karton_id", $karton_id);
			$izraz->execute();	
			$prviDatumZadnjegSetaTerapija = $izraz->fetch(PDO::FETCH_OBJ);		
			
			return ($prviDatumZadnjegSetaTerapija!=null) ? $this->hrDatum($prviDatumZadnjegSetaTerapija->datum) : null;
		}else{
			return null;
		}
	}
	
	public function insertSetTh(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$prvaTh = $this->prvaTh;
		$zadnjaTh = $this->zadnjaTh;
		$karton_id = $this->karton_id;
		
		$prvaTerapija = new DateTime($prvaTh);
		$zadnjaTerapija = new DateTime($zadnjaTh);
		$zadnjaTerapija->add(new DateInterval('P1D')); //dodati jedan dan radi loopa
		$interval = DateInterval::createFromDateString('1 day'); //iteriraj dan po dan
		$period = new DatePeriod($prvaTerapija, $interval, $zadnjaTerapija); //interval dana između dva datuma
	
		if(iterator_count($period)<=30){
			//unos novog seta terapija
			foreach ($period as $dt) {
				$danUTj = $dt->format('N');
				$datumZaProvjeru = $dt->format('d.m.Y.');
				$datumZaUnos = $dt->format('Y-m-d');
				if($danUTj!=6&&$danUTj!=7&&!in_array($datumZaProvjeru, $this->neradniDani)){ //ako dan nije vikend ili neradni dan u godini
					$izraz = $veza->prepare("insert into kartoni_terapije(karton_id,datum) values(:karton_id,:datum);");
					$izraz->bindParam(":karton_id", $karton_id);
					$izraz->bindParam(":datum", $datumZaUnos);
					$izraz->execute();	
				}
	 		}
			return 'Unešeno';
		}else{
			return 'Od prve do zadnje terapije može biti najviše 30 dana razlike.';
		}
		
	}
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$idsJSON = json_decode($_POST["ids"]);
		$arrayIds = array();
		
		foreach ($idsJSON as $ids) {
			array_push($arrayIds,$ids->id);		
		}
		$in = implode(',', $arrayIds);
		
		//brisanje upisanih terapija
		$sql = "delete from kartoni_terapije where id in(" . $in . ") and karton_id=:karton_id;";
		$izraz = $veza->prepare($sql);
		$izraz->bindParam(":karton_id", $_POST["karton_id"]);
		$izraz->execute();	
		
		return "Datumi terapija obrisani";	
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje upisanih terapija
		$izraz = $veza->prepare("update kartoni_terapije set datum=:datum where id=:id;");
		$izraz->bindParam(":id", $_POST["id"]);
		$izraz->bindParam(":datum", $_POST["datum"]);
		$izraz->execute();	
		
		return "Promijenjeno";			
	}
	
	protected function hrDatum($str){
		$date = (empty($str)) ? null :date("d.m.Y.", strtotime($str));
		return $date;
	}

}
