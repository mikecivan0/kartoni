<?php
class NeradniDan extends SQL{
	
	public $noviDatumi;
	public $stariDatumi;
	private $path;
	
	function __construct(){		
		$this->stariDatumi = '';
		$this->path = '../../klase/Terapija.php';
	}
	
	public function setNoviDatumi($noviDatumi){
		$this->noviDatumi = $noviDatumi;
	}
	
	public function setStariDatumi($stariDatumi){
		$this->stariDatumi = $stariDatumi;
	}
		
	public function get(){
		
		$sadrzaj = file_get_contents($this->path);
		$listaStarihDatuma = $this->get_string_between($sadrzaj, 'neradniDani = array(', ');');
		$listaNovihDatuma = str_replace(array("'",","),array("",", "),$listaStarihDatuma);
		
		$this->setStariDatumi($listaStarihDatuma);
		$this->setNoviDatumi($listaNovihDatuma);
		
	}

	public function update(){		
		
		$stariDatumi = 'neradniDani = array(' . $this->stariDatumi . ');';
		$noviDatumi = str_replace(array('"',';'), '', trim($this->noviDatumi)); //izbaci razmake sa krajeva, dvostruke navodnike i točku-zarez
		$noviDatumiTrimZarez = trim($noviDatumi,","); //izbaci zareze sa krajeva
		
		$noviDatumiBezRazmaka = str_replace(array("'"," ","  ","   "),"",$noviDatumiTrimZarez); //izbaci jednostruke navodnike i višestruke razmake
		$noviDatumiSaNavodnicima = "'" . str_replace(",","','",$noviDatumiBezRazmaka) . "'"; //dodaj jednostruke navodnike lijevo i desno od zareza i na početak i kraj stringa
		$noviDatumiCijeliArray = 'neradniDani = array(' . $noviDatumiSaNavodnicima . ');'; //ubaci string u array
		
		$strTerapije = file_get_contents($this->path);		
		$novo = str_replace($stariDatumi,$noviDatumiCijeliArray,$strTerapije);
			
		$path_file = fopen($this->path, 'w');
		fwrite($path_file, $novo);
		fclose($path_file);

		
	}
	
	private function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}

}
