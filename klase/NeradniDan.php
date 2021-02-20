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
		$noviDatumi = trim($this->noviDatumi);
		$noviDatumiTrimZarez = trim($noviDatumi,",");
		
		$noviDatumiBezRazmaka = str_replace(array(" ","  ","   "),"",$noviDatumiTrimZarez);
		$noviDatumiSaNavodnicima = "'" . str_replace(",","','",$noviDatumiBezRazmaka) . "'";
		$noviDatumiCijeliArray = 'neradniDani = array(' . $noviDatumiSaNavodnicima . ');';
		
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
